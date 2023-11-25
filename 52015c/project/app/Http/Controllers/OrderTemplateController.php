<?php

namespace App\Http\Controllers;

use App\AccountManager;
use App\Order;
use App\OrderedProducts;
use App\OrderTemplate;
use App\OrderTemplateItem;
use App\Product;
use App\Clients;
use App\Models\EmailSubject;
use App\Models\EmailTemplate;
use Carbon\Carbon;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Mail\ScheduleOrderPlaced;
use Redirect;
use Illuminate\Support\Facades\DB;

class OrderTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['templateForm'])) {
            $query = "";
            if (isset($_GET['template']) && $_GET['template'] != "") {
                $query .= " and order_templates.name like '%" . $_GET['template'] . "%'";
            }

            if (isset($_GET['status']) && $_GET['status'] != "") {
                $query .= " and  order_templates.is_active='" . $_GET['status'] . "'";
            }

            if (isset($_GET['repeat']) && $_GET['repeat'] != "") {
                $query .= " and  order_templates.repeat='" . $_GET['repeat'] . "'";
            }
            if (isset($_GET['business']) && $_GET['business'] != "") {
                $query .= " and  clients.business_name like '%" . $_GET['business'] . "%'";
            }

            $orders = "SELECT order_templates.id AS template_id,order_templates.name AS template_name,clients.business_name,job_type.name AS job_type,order_templates.repeat,order_templates.schedule_from,order_templates.is_active  
                       FROM order_templates 
                       LEFT JOIN clients ON order_templates.client_id =clients.id 
                       LEFT JOIN job_type ON job_type.id=order_templates.job_type_id 
                       WHERE order_templates.vendor_id=" . Auth::user()->id . " " . $query;

            $orders = DB::select(DB::raw($orders));
        } else {

            $orders = OrderTemplate::select('order_templates.id AS template_id', 'order_templates.name AS template_name', 'clients.business_name', 'job_type.name As job_type', 'order_templates.repeat', 'order_templates.schedule_from', 'order_templates.is_active')->where('order_templates.vendor_id', Auth::user()->id)->orderBy('order_templates.id', 'desc')
                ->leftjoin('clients', 'order_templates.client_id', '=', 'clients.id')
                ->leftjoin('job_type', 'job_type.id', '=', 'order_templates.job_type_id')
                ->get();

        }
        return view('vendor.repeat-templates-list', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $accountManagers = DB::connection('mysql2')->table('EMPLOYEE')
            ->join('employee_company_details', 'EMPLOYEE.UID', '=', 'employee_company_details.employee_id')
            ->where('employee_company_details.department_id', 3)
            ->get();
        $vendor_id = Auth::user()->id;
        $job_type = DB::connection('mysql2')->table('JOB_TYPE')->get();
        return view('vendor.template-create-customer', compact('id', 'accountManagers', 'job_type', 'vendor_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array(

            "name" => 'required',
            "job_type_id" => 'required',
            "repeat" => 'required',
            "days_allowed" => 'required',
            "schedule_from" => 'required',
            "avg_service_time" => 'numeric',
            "is_active" => 'required'

        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

            $input = $request->all();

        }
        $input = $request->all();
        $dateFromat=explode("-",$input['schedule_from']);
        $dateFromated=$dateFromat[2]."-".$dateFromat[0]."-".$dateFromat[1];
        $template = OrderTemplate::create(
            [
                'client_id'=> $input['client_id'],
                'vendor_id'=> $input['vendor_id'],
                'name' => $input['name'],
                'manager_id' => $input['manager_id'],
                'job_type_id' => $input['job_type_id'],
                'repeat' =>$input['repeat'],
                'days_apart' => $input['days_apart'],
                'weeks_apart' => $input['weeks_apart'],
                'months_apart' => $input['months_apart'],
                'days_allowed' => $input['days_allowed'],
                'schedule_from' => $dateFromated,
                'avg_service_time' => $input['avg_service_time'],
                'is_active' => $input['is_active'],
                'special_notes' => $input['special_notes'],
                'name_for_sams' => $input['name_for_sams'],
                'payment_method' => $input['payment_method'],
            ]
        );
        Session::flash('message', 'Template has been successfully created');
        return Redirect::route('order-template.show', ['order_template' => $template]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\OrderTemplate $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(OrderTemplate $orderTemplate)
    {
        $products = Product::where('vendorid', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->pluck('id', 'title');

        $job_type = DB::connection('mysql2')->table('JOB_TYPE')->where('UID', $orderTemplate->job_type_id)->first();
        $accountManager = DB::connection('mysql2')->table('EMPLOYEE')->where('UID', $orderTemplate->manager_id)->first();
        $orderTemplateItems = OrderTemplateItem::whereOrderTemplateId($orderTemplate->id)->get();
        return view('vendor.ordertemplate-show', compact('orderTemplate', 'products', 'orderTemplateItems', 'job_type', 'accountManager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\OrderTemplate $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderTemplate = OrderTemplate::findOrFail($id);
        $accountManagers = DB::connection('mysql2')->table('EMPLOYEE')
            ->join('employee_company_details', 'EMPLOYEE.UID', '=', 'employee_company_details.employee_id')
            ->where('employee_company_details.department_id', 3)
            ->get();

        $job_type = DB::connection('mysql2')->table('JOB_TYPE')->get();

        return view('vendor.template-edit-customer', compact('orderTemplate', 'id', 'accountManagers', 'job_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\OrderTemplate $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            "name" => 'required',
            "job_type_id" => 'required',
            "repeat" => 'required',
            "days_allowed" => 'required',
            "schedule_from" => 'required',
            "avg_service_time" => 'numeric',
            "is_active" => 'required',
            "payment_method" => 'required'

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
            $input = $request->all();

        }
        if ($request->input('template_id')) {

            $dateFromat=explode("-",$request->input('schedule_from'));
            $dateFromated=$dateFromat[2]."-".$dateFromat[0]."-".$dateFromat[1];
            $template = OrderTemplate::where('id', $request->input('template_id'))->first(); 
            $template->name = $request->input('name');
            $template->job_type_id = $request->input('job_type_id');
            $template->repeat = $request->input('repeat');
            $template->days_apart = $request->input('days_apart');
            $template->weeks_apart = $request->input('weeks_apart');
            $template->months_apart = $request->input('months_apart');
            $template->days_allowed = $request->input('days_allowed');
            $template->schedule_from =  $dateFromated;
            $template->avg_service_time = $request->input('avg_service_time');
            $template->is_active = $request->input('is_active');
            $template->special_notes = $request->input('special_notes');
            $template->manager_id = $request->input('manager_id');
            $template->name_for_sams = $request->input('name_for_sams');
            $template->payment_method = $request->input('payment_method');
            $template->update();
        }
        Session::flash('message', 'Template has been successfully updated');
        return Redirect::route('order-template.show', ['order_template' => $template]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\OrderTemplate $orderTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function repeatTemplateDelete($id)
    {
        $template = OrderTemplate::findOrFail($id);
        $client_id = $template->client_id;
        $template->delete();
        return redirect('vendor/customer/' . $client_id . '/templates')->with('message', 'Template Delete Successfully.');
    }

    public function getTemplateAjax($client_id)
    {

        $templates = OrderTemplate::join('clients', 'order_templates.client_id', '=', 'clients.id')
            ->join('vendor_customers', 'vendor_customers.customer_id', '=', 'order_templates.client_id')
            ->join('job_type', 'order_templates.job_type_id', '=', 'job_type.id')
            ->select('order_templates.*','job_type.name AS typeName')
            ->where('vendor_customers.vendor_id', Auth::user()->id)->where('order_templates.client_id', $client_id);

        if ($_GET['template_name']) {
            $templates->where('order_templates.name', 'like',  "%{$_GET['template_name']}%");
        }
        if ($_GET['repeat']) {
            $templates->where('order_templates.repeat', '=',  "{$_GET['repeat']}");
        }
        $type = str_replace('=', '', $_GET['type']);
        if ($type) {
            $templates->where('order_templates.job_type_id', $type);
        }
        if (($_GET['fromTime']) && $_GET['toTime']) {
            $templates->whereBetween('order_templates.last_updated_date', [date('Y-m-d', strtotime($_GET['fromTime'])), date('Y-m-d', strtotime($_GET['toTime']))]);
        }

        return Datatables::of($templates)
            ->addColumn('last_date', function ($template) {
                return (!empty($template->last_updated_date))?date('m-d-Y', strtotime($template->last_updated_date)):'N/A';
            })
            ->addColumn('action', function ($template) {
                return '<a href="/vendor/order-template/' . $template->id . '/edit" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a>'
                    . '<a href="/vendor/order-template/' . $template->id . '" class="ml-2 btn btn-xs btn-info"><i class="glyphicon glyphicon-eye"></i>&nbsp;View</a>'
                    . '<a href="/vendor/repeat-template-delete/' . $template->id . '" class="ml-2 btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i>&nbsp;Delete</a>';
            })
            ->make(true);
    }

    public function getTemplateByVendor()
    {
        $templates = OrderTemplate::join('clients', 'order_templates.client_id', '=', 'clients.id')
            ->join('vendor_customers', 'vendor_customers.customer_id', '=', 'order_templates.client_id')
            ->join('job_type', 'order_templates.job_type_id', '=', 'job_type.id')
            ->select('order_templates.id', 'order_templates.name', 'job_type.name AS typeName', 'order_templates.repeat', 'order_templates.schedule_from')
            ->where('vendor_customers.vendor_id', Auth::user()->id);

        return Datatables::of($templates)
            ->addColumn('action', function ($template) {
                return '<a href="/vendor/order-template/' . $template->id . '/edit" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>'
                    . '<a href="/vendor/order-template/' . $template->id . '" class="ml-2 btn btn-xs btn-info"><i class="glyphicon glyphicon-eye"></i> View</a>';
            })
            ->make(true);
    }

    public function getTemplateOrderAjax($client_id)
    {
        $orders = Order::select('orders.*', 'job_type.name as type','clients.name as customer_name')
            ->leftJoin('job_type', 'orders.job_type', '=', 'job_type.id')
            ->leftJoin('clients', 'orders.customerid', '=', 'clients.id')
            ->where('orders.customerid', $client_id);

        if ($_GET['orderId']) {
            $orders->where('orders.id', $_GET['orderId']);
        }

        if ($_GET['quickdate']) {
            $all = false;
            switch ($_GET['quickdate']) {
                case 'today':
                    $start = date('Y-m-d');
                    $end = date('Y-m-d');
                    break;
                case 'yesterday':
                    $start = date('Y-m-d', strtotime('yesterday'));
                    $end = date('Y-m-d', strtotime('yesterday'));
                    break;
                case 'tomorrow':
                    $start = date('Y-m-d');
                    $end = date('Y-m-d', strtotime('tomorrow'));
                    break;
                case 'wholeweek':
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $end = date('Y-m-d', strtotime('sunday this week'));
                    break;
                case 'weekday':
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $end = date('Y-m-d', strtotime('friday this week'));
                    break;
                case 'nextweek':
                    $start = date('Y-m-d', strtotime('monday next week'));
                    $end = date('Y-m-d', strtotime('sunday next week'));
                    break;
                case 'thismonth':
                    $start = date('Y-m-d', strtotime('first day of this month'));
                    $end = date('Y-m-d', strtotime('last day of this month'));
                    break;
                case 'nextmonth':
                    $start = date('Y-m-d', strtotime('first day of next month'));
                    $end = date('Y-m-d', strtotime('last day of next month'));
                    break;
                case 'thisyear':
                    $start = date('Y-m-d', strtotime('first day of January'));
                    $end = date('Y-m-d', strtotime('last day of December'));
                    break;
                case 'yeartodate':
                    $start = date('Y-m-d', strtotime('first day of January'));
                    $end = date('Y-m-d');
                    break;
                default:
                    $all = true;
            }
            if (!$all) {
                $orders->whereBetween('orders.booking_date', [$start, $end]);
            }

        }
        if (isset($_GET['clientName']) && $_GET['clientName'] != "") {
            $orders->where('clients.name', 'like','%'.$_GET['clientName'].'%');
        }
        if (($_GET['fromTime']) && $_GET['toTime']) {
            $orders->whereBetween('orders.booking_date', [date('Y-m-d', strtotime($_GET['fromTime'])), date('Y-m-d', strtotime($_GET['toTime']))]);
        }
        if ($_GET['status']) {
            $orders->where('orders.status', $_GET['status']);
        }
        if ($_GET['method']) {
            $orders->where('orders.method', $_GET['method']);
        }
        $type = str_replace('=', '', $_GET['type']);
        if ($type) {
            $orders->where('orders.job_type', $type);
        }
        return Datatables::of($orders)
            ->addColumn('action', function ($orders) {
                if($orders->order_type==3){
                    return '<a href="/vendor/order-template-order-repeat/' . $orders->id . '" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>'
                        . '&nbsp;<a href="#" class="ml-2 btn btn-xs btn-success" onclick="modalSend('.$orders->id.')" data-toggle="modal" data-target="#send"  data-orderid="'.$orders->id.'"><i class="fa fa-send"></i></a>'
                        . '&nbsp;<a href="/vendor/order-template-delete/' . $orders->id . '" class="ml-2 btn btn-xs btn-danger"><i class="fa fa-remove"></i></a>';
                }
                else {
                    return '<a href="/vendor/order-template-order/' . $orders->id . '" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>'
                        . '&nbsp;<a href="#" class="ml-2 btn btn-xs btn-success" onclick="modalSend('.$orders->id.')" data-toggle="modal" data-target="#send"  data-orderid="'.$orders->id.'"><i class="fa fa-send"></i></a>'
                        . '&nbsp;<a href="/vendor/order-template-delete/' . $orders->id . '" class="ml-2 btn btn-xs btn-danger"><i class="fa fa-remove"></i></a>';
                }

            })
            ->make(true);

    }

    public function OrderTemplateOrderViewRepeat($id)
    {
        $order = Order::where('id', $id)->first();
        $products = OrderTemplateItem::where('order_template_id', $order->template_id)->get();
        return view('vendor.ordertemplate-order-show-repeat', compact('order', 'products'));
    }

    public function getOrderTemplateActivate(Request $request)
    {
        $input = $request->all();
        foreach ($input['isActive_arr'] AS $arr) {
            $orders = OrderTemplate::where('id', $arr);
            $orders->update(['is_active' => 1]);
        }
        return $input['isActive_arr'];
    }

    public function getTemplateOrderDelete(Request $request)
    {
        $input = $request->all();
        foreach ($input['deleteids_arr'] AS $arr) {
            $this->OrderTemplateOrderDelete($arr);
        }
        return $input['deleteids_arr'];
    }

    public function makeRecurringOrder(Request $request)
    {
        $template = OrderTemplate::whereId($request->order_template_id)->first();
        $scheduleFrom=date('Y-m-d', strtotime($template->schedule_from));
        $today=date('Y-m-d',time());
        $items = OrderTemplateItem::whereOrderTemplateId($request->order_template_id)->get();
   
        if (count($items) > 0) 
        {
            $products = [];
            $quantities = [];
            $prices = [];
            $price = 0;
            $subtotal = 0;
            if (!empty($items)) {
                foreach ($items as $item) {
                    $products[] = $item->product_id;
                    $prices[] = $item->base_price;
                    $quantities[] = $item->qty;
                    $subtotal += $item->base_price;
                    $price += $item->base_price * $item->qty;
                }
            }
            $tax = $price * 0.13;
            $cost = $tax + $price;
            $products = implode(',', $products);
            $quantities = implode(',', $quantities);
            if ($request->order_template_type == OrderTemplate::NEXT_MONTH) {
            	$start = date('Y-m-d');
                $end_date = date('Y-m-d',strtotime($start. ' + 30 days'));
                $start_date = Carbon::parse($start);
                $days_allowed = $template->days_allowed;
                $i = 0;
                $incrementData=$start_date;
                while ($incrementData <= $end_date) {
                    $incrementData = date('Y-m-d', strtotime("+" . $i . " day", strtotime($start)));
                    $dayList = $this->getDateRange($start, $end_date, $template->days_apart,$days_allowed);
                    if (in_array($incrementData, $dayList)) {
                        $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                    }

                    $i++;
                }
                Session::flash('message', 'Next calender orders has been successfully created');
                return Redirect('/vendor/order-template-history/'.$template->client_id.'/'.$template->id);
            }
            elseif ($request->order_template_type == OrderTemplate::RANGE) {
                $dates = explode('-', $request->dates);
                $start_date = date('Y-m-d', strtotime($dates[0]));
                $end_date = date('Y-m-d', strtotime($dates[1]));
                $days_allowed = $template->days_allowed;
                $i = 0;
                if($scheduleFrom <=$end_date)
                {
                $incrementData=$start_date;
                while ($incrementData <= $end_date) { 
                    $incrementData = date('Y-m-d', strtotime("+" . $i . " day", strtotime($start_date)));
                    if ($template->days_apart != '') 
                    {
                        $dayList = $this->getDateRange($start_date, $end_date, $template->days_apart,$days_allowed);
                        if (in_array($incrementData, $dayList)) {
                            $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                        }
                   } 
                    // switch ($template->repeat) {
                    //     case 'Daily':
                    //         if ($template->days_apart != '') {
                    //             $dayList = $this->getDateRange($start_date, $end_date, $template->days_apart,$days_allowed);
                    //             if (in_array($incrementData, $dayList)) {
                    //                 $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                    //             }
                    //         }
                    //         break;

                    //     case 'Weekly':

                    //         if ($template->weeks_apart != '') {
                    //         	 $Weeks = $this->getWeeklyDateRange($start_date, $end_date, $template->weeks_apart,$days_allowed);
                    //             if (in_array($incrementData, $Weeks)) {
                    //                 $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                    //             }
                    //         }
                    //         break;

                    //     case 'Monthly':
                    //         if ($template->months_apart != '') {
                    //             $monthList = $this->getMonthRange($start_date, $end_date, $template->months_apart,$days_allowed);
                    //             if (in_array($incrementData, $monthList)) {
                    //                 $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                    //             }
                    //         }

                    //         break;

                    //     case 'Quarterly':
                    //         $monthList = $this->getQuarterlyRange($start_date, $end_date, $days_allowed);
                    //         if (in_array($incrementData, $monthList)) {
                    //             $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                    //         }
                    //         break;

                    //     case 'Semi-Annual':
                    //         $monthList = $this->getSemiAnnualRange($start_date, $end_date, $days_allowed);
                    //         if (in_array($incrementData, $monthList)) {
                    //             $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                    //         }
                    //         break;

                    //     case 'Yearly':
                    //         $monthList = $this->getYearlyRange($start_date, $end_date, $days_allowed);
                    //         if (in_array($incrementData, $monthList)) {
                    //             $this->generateRepeatOrders($template, $quantities, $products, $incrementData, $cost, $prices);
                    //         }
                    //         break;
                    // }

                    $i++; 

                }
                  Session::flash('message', 'Date range orders has been successfully created');
                  return Redirect('/vendor/order-template-history/'.$template->client_id.'/'.$template->id);
                } 
                else 
                {
                  Session::flash('error', 'Please select date range after schedule from date.');
                  return Redirect('/vendor/order-template/'.$template->id);
            	}
            }
            elseif ($request->order_template_type == OrderTemplate::SINGlE_DATE) {
            	$date=explode('/',$request->date);
            	$date=$date[2]."-".$date[0]."-".$date[1];
            	 if($scheduleFrom <=$date)
            	 {
	            	if (empty($request->date)) {
	                    Session::flash('error', 'There is no date selected to generate repeat orders, please select a date and retry');
	                    return Redirect('/vendor/order-template/'.$template->id);
	                } else {
	  
	                       $date = date('Y-m-d', strtotime($date));
	                       $this->generateRepeatOrders($template, $quantities, $products, $date, $cost, $prices);

	                    Session::flash('message', 'Single day order has been successfully created');
	                    return Redirect('/vendor/order-template-history/'.$template->client_id.'/'.$template->id);
	                }
            	 } else 
                 {
                  Session::flash('error', 'Please select date after schedule from date.');
                  return Redirect('/vendor/order-template/'.$template->id);
            	 }

            }
            else {
                Session::flash('message', 'Order creation failed.');
                return Redirect('/vendor/order-template/'.$template->id);
            }
        } else {
            Session::flash('error', 'No products were assigned or not a active templates.');
            return Redirect('/vendor/order-template/'.$template->id);
        }

    }

    public function generateRepeatOrders($template, $quantities, $products, $dateIncrement, $cost, $prices)
    {
        $order = Order::create([
            'order_type' => Order::REPEAT_ORDERS,
            'template_id' => $template->id,
            'customerid' => $template->client_id,
            'quantities' => $quantities,
            'products' => $products,
            'payment_status' => "Pending",
            'customer_email' => $template->client->email,
            'customer_name' => $template->client->firstname . " " . $template->client->lastname,
            'customer_phone' => $template->client->phone,
            'customer_address' => $template->client->address,
            'customer_city' => $template->client->city,
            'customer_zip' => $template->client->zip,
            'shipping_email' => $template->email,
            'shipping_name' => $template->name,
            'shipping_phone' => $template->phone,
            'shipping_address' => $template->address,
            'shipping_city' => $template->city,
            'shipping_zip' => $template->zip,
            'job_type' => $template->job_type_id,
            'job_notes' => $template->special_notes,
            'job_status' => 'Scheduled',
            'job_name' => $template->name,
            'booking_date' => $dateIncrement,
            'status' => "scheduled",
            'job_service_time' => $template->avg_service_time,
            'po_number' => $template->po_cro_no,
            'method' => $template->payment_method,
            'pay_amount' => number_format((float)$cost, 2, '.', ''),
        ]);
        $productIds = explode(',', $products);
        $productQuantities = explode(',', $quantities);
        foreach ($productIds as $data => $product) {
            $orderProduct = new OrderedProducts();

            $product = Product::findOrFail($product);

            $orderProduct['orderid'] = $order->id;
            $orderProduct['owner'] = $product->owner;
            $orderProduct['vendorid'] = $product->vendorid;
            $orderProduct['productid'] = $productIds[$data];
            $orderProduct['quantity'] = $productQuantities[$data];
            $orderProduct['payment'] = "pending";
            $orderProduct['cost'] = $prices[$data] * $productQuantities[$data];
            $orderProduct->save();

            $stocks = $product->stock - $productQuantities[$data];
            if ($stocks < 0) {
                $stocks = 0;
            }
            $quant['stock'] = $stocks;
            $product->update($quant);
        }

    }

    public function OrderTemplateOrderView($id)
    {
        $order = Order::where('id', $id)->first();
        $products = OrderedProducts::where('orderid', $id)->get();
        return view('vendor.ordertemplate-order-show', compact('order', 'products'));
    }

    public function OrderTemplateOrderHistory($id)
    {
        $order = Order::where('id', $id)->first();
        $products = OrderedProducts::where('orderid', $id)->get();
        return view('vendor.ordertemplate-history', compact('order', 'products'));
    }

    public function OrderTemplateOrderDelete($id)
    {
        $order = Order::where('id', $id)->first();
        $customerid = $order->customerid;
        $order->delete();
        $products = OrderedProducts::where('orderid', $id)->get();
        foreach ($products as $product) {
            $product->delete();
        }
        Session::flash('message', 'Order has been successfully Deleted');
        return Redirect('/vendor/customer/' . $customerid . '/orders?orderId=&quickdate=&fromTime=&toTime=&status=&method=&type=&orderForm=Search');
    }

    public function getMonthRange($start_date, $end_date, $months_apart,$days_allowed)
    {
        $startMonth = date('Y-m-d', strtotime($start_date));
        $startDate = Carbon::parse($startMonth);
        $startMonth = $startDate->month;
        $endMonth = date('Y-m-d', strtotime($end_date));
        $endDate = Carbon::parse($endMonth);
        $endMonth = $endDate->month;

        $i = 0;
        foreach (range($startMonth, $endMonth, $months_apart) as $number) {

            if ($i == 0) {
                $first_start = date('Y-m-d', strtotime($start_date));
                $first_end = date('Y-m-d', strtotime('last day of this month', strtotime($start_date)));
                $monthData = array('month' => $i, 'start' => $first_start, 'end' => $first_end);
            } else {
                $month = date('Y-m-d', strtotime("+" . $i . " month", strtotime($start_date)));
                $month_start = date('Y-m-d', strtotime('first day of this month', strtotime($month)));
                $month_end = date('Y-m-d', strtotime('last day of this month', strtotime($month)));
                $monthData = array('month' => $i, 'start' => $month_start, 'end' => $month_end);
            }
            $monthList[] = $monthData;

            $i = $number;
        }

        foreach ($monthList AS $value) {
            $finalOut[] = $this->getMonthRangeByNext($value['start'],$value['end']);
        }


        $finalList = $this->putOneList($finalOut);
        foreach ($finalList As $days)
        {
            $day = Carbon::parse($days);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed))
            {
                $list[]=$days;
            }
        }
       return $list;
    }

    public function getMonthRangeByNext($first,$last)
    {
        $i = 0;
        while (end($datesFirst) < $last) {
            $incrementDate = date('Y-m-d', strtotime($first . '+' . $i . ' days'));
            $datesFirst[] = $incrementDate;
            $i++;
        }
        return $datesFirst;
    }

    public function getDateRange($start_date, $end_date, $days_apart,$days_allowed)
    {
        $i = $days_apart;
        $dates = array($start_date);
        while (end($dates) < $end_date) {
            $incrementDate = date('Y-m-d', strtotime(end($dates) . ' +' . $i . ' days'));
            if ($incrementDate > $end_date) {
                break;
            }
            $dates[] = $incrementDate;
            $i = +$days_apart;
        }
        foreach ($dates As $days)
        {
            $day = Carbon::parse($days);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed))
            {
                $list[]=$days;
            }
        }
        return $list;
    }

    public function getDateRangeNonApart($start_date, $end_date)
    {
        $i = 0;
        $dates = array($start_date);
        while (end($dates) < $end_date) {
            $incrementDate = date('Y-m-d', strtotime(end($dates) . ' +' . $i . ' days'));
            if ($incrementDate > $end_date) {
                break;
            }
            $dates[] = $incrementDate;
            $i++;
        }

        return $dates;
    }

    public function getDatesFromRange($start, $end)
    {

        $dates = array($start);
        while (end($dates) < $end) {
            $dates[] = date('Y-m-d', strtotime(end($dates) . ' +1 day'));
        }

        return $dates;
    }

    public function putOneList($finalList)
    {
        foreach ($finalList AS $key => $val) {
            foreach ($val as $value) {
                $flat[] = $value;
            }
        }

        return $flat;

    }

    public function getWeeklyDateRange($start, $end, $weeks_apart,$days_allowed,$next=null)
    {
        $start = date('Y-m-d', strtotime($start));
        $end = date('Y-m-d', strtotime($end));
        $startDate = Carbon::parse($start);

        //print_r($start." ".$end);die;
        $dayWeek = $startDate->dayOfWeek;

        if($next)
        {
            $i = 0;
            while ($i < 7) {
                $incrementDate = date('Y-m-d', strtotime($start . '+' . $i . ' days'));
                $datesFirst[] = $incrementDate;
                $i++;
            }

        } else {
            $dif = 7 - $dayWeek;
            $i = 0;
            while ($i <= $dif) {
                $incrementDate = date('Y-m-d', strtotime(end($start) . '+' . $i . ' days'));
                $datesFirst[] = $incrementDate;
                $i++;
            }
        }


        $startNext = date('Y-m-d', strtotime(end($datesFirst) . '+1 days'));

        while ($incrementDate <= $end) {
            $incrementDate = date('Y-m-d', strtotime("$startNext +" . $weeks_apart . " week"));
            if ($incrementDate >= $end) {
                break;
            }
            $next = $this->getWeeklyDateRangeByNext($incrementDate);
            $datesRest[] = $next;
            $startNext = end($next);
        }

      //print_r($this->putOneList($datesRest));die;
        if ($datesRest) {
            $lastList = array_merge($datesFirst, $this->putOneList($datesRest));
        } else {
            $lastList = $datesFirst;
        }

        foreach ($lastList As $days)
        {
            $day = Carbon::parse($days);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed))
            {
                $list[]=$days;
            }
        }

        print_r($list);die;
        return $list;
    }

    public function getWeeklyDateRangeByNext($next)
    {

        $i = 0;
        while ($i < 7) {
            $incrementDate = date('Y-m-d', strtotime($next . '+' . $i . ' days'));
            $datesFirst[] = $incrementDate;
            $i++;
        }
        return $datesFirst;
    }

    public function getQuarterlyRange($start_date, $end_date, $days_allowed)
    {
        $start_date = date('Y-m-d', strtotime($start_date));
        for ( $i = 0; $i < 60; $i++ ) {
            $incrementDate =  date('Y-m-d', strtotime(' +'.$i.' days', strtotime($start_date)));
            $day = Carbon::parse($incrementDate);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed) AND $incrementDate>$end_date)
            {
                $list[]=$incrementDate;
            }

        }
        return $list;
    }

    public function getSemiAnnualRange($start_date, $end_date, $days_allowed)
    {
        $start_date = date('Y-m-d', strtotime($start_date));
        for ( $i = 0; $i < 180; $i++ ) {
            $incrementDate =  date('Y-m-d', strtotime(' +'.$i.' days', strtotime($start_date)));
            $day = Carbon::parse($incrementDate);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed) AND $incrementDate>$end_date)
            {
                $list[]=$incrementDate;
            }
        }
        return $list;

    }

    public function getYearlyRange($start_date, $end_date, $days_allowed)
    {
        $start_date = date('Y-m-d', strtotime($start_date));
        for ( $i = 0; $i < 360; $i++ ) {
            $incrementDate =  date('Y-m-d', strtotime(' +'.$i.' days', strtotime($start_date)));
            $day = Carbon::parse($incrementDate);
            $allow=$day->dayOfWeek;
            if(in_array($allow,$days_allowed) AND $incrementDate>$end_date)
            {
                $list[]=$incrementDate;
            }
        }
        return $list;
    }

    public function history($id,$temp_id)
    {
        $orders = Order::select('orders.*', 'job_type.name as type')
            ->leftJoin('job_type', 'orders.job_type', '=', 'job_type.id')
            ->leftJoin('order_templates', 'order_templates.id', '=', 'orders.template_id')
            ->where('orders.customerid', $id)->where('orders.template_id',$temp_id)->where('order_templates.vendor_id', Auth::user()->id);
        $client_id=$id;
        $template_id=$temp_id;
        if ($_GET['orderId']) {
            $orders->where('orders.id', $_GET['orderId']);
        }

        if ($_GET['quickdate']) {
            $all = false;
            switch ($_GET['quickdate']) {
                case 'today':
                    $start = date('Y-m-d');
                    $end = date('Y-m-d');
                    break;
                case 'yesterday':
                    $start = date('Y-m-d', strtotime('yesterday'));
                    $end = date('Y-m-d', strtotime('yesterday'));
                    break;
                case 'tomorrow':
                    $start = date('Y-m-d');
                    $end = date('Y-m-d', strtotime('tomorrow'));
                    break;
                case 'wholeweek':
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $end = date('Y-m-d', strtotime('sunday this week'));
                    break;
                case 'weekday':
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $end = date('Y-m-d', strtotime('friday this week'));
                    break;
                case 'nextweek':
                    $start = date('Y-m-d', strtotime('monday next week'));
                    $end = date('Y-m-d', strtotime('sunday next week'));
                    break;
                case 'thismonth':
                    $start = date('Y-m-d', strtotime('first day of this month'));
                    $end = date('Y-m-d', strtotime('last day of this month'));
                    break;
                case 'nextmonth':
                    $start = date('Y-m-d', strtotime('first day of next month'));
                    $end = date('Y-m-d', strtotime('last day of next month'));
                    break;
                case 'thisyear':
                    $start = date('Y-m-d', strtotime('first day of January'));
                    $end = date('Y-m-d', strtotime('last day of December'));
                    break;
                case 'yeartodate':
                    $start = date('Y-m-d', strtotime('first day of January'));
                    $end = date('Y-m-d');
                    break;
                default:
                    $all = true;
            }
            if (!$all) {
                $orders->whereBetween('orders.booking_date', [$start, $end]);
            }

        }
        if (($_GET['fromTime']) && $_GET['toTime']) {
            $orders->whereBetween('orders.booking_date', [date('Y-m-d', strtotime($_GET['fromTime'])), date('Y-m-d', strtotime($_GET['toTime']))]);
        }
        if ($_GET['status']) {
            $orders->where('orders.status', $_GET['status']);
        }

        $jobType = str_replace('=', '', $_GET['jobType']);
        if ($jobType) {
           $orders->where('orders.job_type', $jobType);
        }
        $jobName = str_replace('=', '', $_GET['jobName']);
        if ($jobName) {
            $orders->whereRaw('LOWER(orders.job_name) LIKE  "%'.trim(strtolower($jobName)).'%"');  
        }
        $orderType = str_replace('=', '', $_GET['orderType']);
        if ($orderType) {
            $orders->where('orders.order_type', $orderType);
        }
         $orders->orderBy('orders.id', 'desc')->get();
         $template=OrderTemplate::where('id',$template_id)->first();
         $query = "SELECT * FROM `job_type`";
         $jobType = DB::select(DB::raw($query));
        if (!empty($orders)) {
            return view('vendor.ordertemplate-history', compact('orders','template','jobType','template_id','client_id'));
        } else {
            return NULL;
        }

    }

    public function getTemplateHistoryAjax($client_id,$temp_id)
    {
        $orders = Order::select('orders.*', 'job_type.name as type')
            ->leftJoin('job_type', 'orders.job_type', '=', 'job_type.id')
            ->where('orders.customerid', $client_id)->where('template_id',$temp_id);

        if ($_GET['orderId']) {
            $orders->where('orders.id', $_GET['orderId']);
        }

        if ($_GET['quickdate']) {
            $all = false;
            switch ($_GET['quickdate']) {
                case 'today':
                    $start = date('Y-m-d');
                    $end = date('Y-m-d');
                    break;
                case 'yesterday':
                    $start = date('Y-m-d', strtotime('yesterday'));
                    $end = date('Y-m-d', strtotime('yesterday'));
                    break;
                case 'tomorrow':
                    $start = date('Y-m-d');
                    $end = date('Y-m-d', strtotime('tomorrow'));
                    break;
                case 'wholeweek':
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $end = date('Y-m-d', strtotime('sunday this week'));
                    break;
                case 'weekday':
                    $start = date('Y-m-d', strtotime('monday this week'));
                    $end = date('Y-m-d', strtotime('friday this week'));
                    break;
                case 'nextweek':
                    $start = date('Y-m-d', strtotime('monday next week'));
                    $end = date('Y-m-d', strtotime('sunday next week'));
                    break;
                case 'thismonth':
                    $start = date('Y-m-d', strtotime('first day of this month'));
                    $end = date('Y-m-d', strtotime('last day of this month'));
                    break;
                case 'nextmonth':
                    $start = date('Y-m-d', strtotime('first day of next month'));
                    $end = date('Y-m-d', strtotime('last day of next month'));
                    break;
                case 'thisyear':
                    $start = date('Y-m-d', strtotime('first day of January'));
                    $end = date('Y-m-d', strtotime('last day of December'));
                    break;
                case 'yeartodate':
                    $start = date('Y-m-d', strtotime('first day of January'));
                    $end = date('Y-m-d');
                    break;
                default:
                    $all = true;
            }
            if (!$all) {
                $orders->whereBetween('orders.booking_date', [$start, $end]);
            }

        }
        if (($_GET['fromTime']) && $_GET['toTime']) {
            $orders->whereBetween('orders.booking_date', [date('Y-m-d', strtotime($_GET['fromTime'])), date('Y-m-d', strtotime($_GET['toTime']))]);
        }
        if ($_GET['status']) {
            $orders->where('orders.status', $_GET['status']);
        }
        $jobType = str_replace('=', '', $_GET['jobType']);
        if ($jobType) {
           $orders->where('orders.job_type', $jobType);
        }
        $jobName = str_replace('=', '', $_GET['jobName']);
        if ($jobName) {
            $orders->whereRaw('LOWER(orders.job_name) LIKE  "%'.trim(strtolower($jobName)).'%"');  
        }
        $orderType = str_replace('=', '', $_GET['orderType']);
        if ($orderType) {
            $orders->where('orders.order_type', $orderType);
        }
        $orders->orderBy('orders.id', 'desc')->get();
        return Datatables::of($orders)
            ->addColumn('action', function ($orders) {
                return '<a href="/vendor/order-template-order-view/' . $orders->id . '" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye"></i> View</a>'
                    . '&nbsp;<a href="#" class="ml-2 btn btn-xs btn-success" onclick="modalSend('.$orders->id.')" data-toggle="modal" data-target="#send"  data-orderid="'.$orders->id.'"><i class="glyphicon glyphicon-send"></i> Email</a>'
                    . '&nbsp;<a href="/vendor/order-template-history-delete/' . $orders->id . '" class="ml-2 btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</a>';

            })
            ->make(true);
    }

    public function OrderTemplateHistoryView($id)
    {
        $order = Order::where('id', $id)->first();
        $products = OrderTemplateItem::where('order_template_id', $order->template_id)->get();
        return view('vendor.ordertemplate-history-order-show', compact('order', 'products'));
    }

    public function OrderTemplateHistoryDelete($id)
    {
        $order = Order::where('id', $id)->first();
        $customerid = $order->customerid;
        $order->delete();
        $products = OrderedProducts::where('orderid', $id)->get();
        foreach ($products as $product) {
            $product->delete();
        }
        Session::flash('message', 'Order has been successfully Deleted');
        return Redirect('/vendor/order-template-history/' . $customerid . '/'.$order->template_id.'/');
    }

    public function notify(Request $request)
    {
        //find booking
        if ($request->order_id)
        {
            $order = Order::where('id', $request->order_id)->first();
            $customerid = $order->customerid;
            $client = Clients::whereId($customerid)->first();
            //send email to customer - refund true
            try {
                // Send Booking Cancelled email
                // customer email
                $EmailSubjectCustomer = EmailSubject::where('token', 'Kc0zS251')->first();
                $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubjectCustomer['id'])->first();
                $status=Mail::to($request->send_email)->send(new ScheduleOrderPlaced($client->name, $order, $EmailSubjectCustomer['subject'], $EmailTemplate));
               

            } catch (\Exception $ex) {
               // print_r($ex);
            }
            //set success message and redirect to bookings.show
            Session::flash('message', __('Vendor repeat order invoice successfully sent.'));
            return Redirect('/vendor/order-template-history/' . $customerid . '/'.$order->template_id.'/');
        }
    }

    public function notifyAll(Request $request)
    {
        //find booking
        if ($request->order_ids)
        {
            $order_ids=explode(',',$request->order_ids);
            $orders = Order::whereIn('id',$order_ids)->get();
            $customerid = $orders[0]->customerid;
            $client = Clients::whereId($customerid)->first();
            //send email to customer - refund true
            try {
                // Send Booking Cancelled email
                foreach ($orders As $order)
                {
                    // customer email
                    $EmailSubjectCustomer = EmailSubject::where('token', 'Kc0zS251')->first();
                    $EmailTemplate = EmailTemplate::where('domain', 2)->where('subject_id', $EmailSubjectCustomer['id'])->first();
                    Mail::to($request->send_email)->send(new ScheduleOrderPlaced($client->name, $order, $EmailSubjectCustomer['subject'], $EmailTemplate));
                }

            } catch (\Exception $ex) {
               //print_r($ex);
            }
            //set success message and redirect to bookings.show
            Session::flash('message', __('Vendor repeat orders invoices successfully sent.'));
            return Redirect('/vendor/order-template-history/' .$customerid. '/'.$order->template_id.'/');
        }
    }




}
