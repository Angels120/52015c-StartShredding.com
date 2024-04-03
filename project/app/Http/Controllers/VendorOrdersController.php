<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorOrdersController extends Controller
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

        $customer_array = [];

    	if(isset($_GET['orderForm'])){
    		$query="";
			
			if(isset($_GET['orderId']) && $_GET['orderId']!=""){
				$query.=" and ordered_products.orderid='".$_GET['orderId']."'";
			}
			$startTime = date('Y-m-d 00:00:00');
			$endTime = date('Y-m-d 23:59:59');
			if(isset($_GET['time']) && $_GET['time']!=""){
				
				switch ($_GET['time']) {
					case 'week':
						$startTime = date('Y-m-d 00:00:00',strtotime('this week'));
						$endTime = date('Y-m-d H:i:s');
						break;
					case 'month':
						$startTime = date('Y-m-d 00:00:00',strtotime('first day of this month'));
						$endTime = date('Y-m-d H:i:s');
						break;
						
					case 'year':
						$startTime = date('Y-m-d 00:00:00',strtotime('first day of January '.date('Y')));
						$endTime = date('Y-m-d H:i:s');
						break;
					case 'lastYear':
						$lastYear=date('Y')-1;
						$startTime = date('Y-m-d 00:00:00',strtotime('first day of January '.$lastYear));
						$endTime = date('Y-m-d 23:59:59', strtotime('Dec 31'));
						break;
					case 'all':
						$startTime = date('Y-m-d 00:00:00',strtotime('first day of January 1970'));
						$endTime = date('Y-m-d H:i:s');
						break;
					
				}	
				
				$query.=" and  ordered_products.created_at>='".$startTime."' and ordered_products.created_at<='".$endTime."'";
			}
			else{
				
				
				if(isset($_GET['fromTime']) && $_GET['fromTime']!=""){
					$query.=" and  ordered_products.created_at>='".date('Y-m-d 00:00:00',strtotime($_GET['fromTime']))."'";
				}
				
				if(isset($_GET['toTime']) && $_GET['toTime']!=""){
					$query.=" and  ordered_products.created_at<='".date('Y-m-d 23:59:59',strtotime($_GET['toTime']))."'";
				}
				
			}
			if(isset($_GET['process']) && $_GET['process']!=""){
				$query.=" and  ordered_products.status='".$_GET['process']."'";
			}	

			if(isset($_GET['paidStatus']) && $_GET['paidStatus']!=""){
				$query.=" and  ordered_products.payment='".$_GET['paidStatus']."'";
			}		
			
			
			
			$userString="";
			$namesearch=false;
			if(isset($_GET['clientName']) && $_GET['clientName']!=""){
				$usersquery="select * from clients where name like '%".$_GET['clientName']."%'";
				$users = DB::select(DB::raw($usersquery));	
				$userArray=array();
				if($users!=null){
					foreach($users as $user){
						$userArray[]=$user->id;
					}
				}
				if(count($userArray)>0){
					$userString=implode(',', $userArray);	
				}
				$namesearch=true;
			}
			
			if($namesearch){
				if($userString!=""){ 
					$orders = "SELECT *,ordered_products.status as status, orders.status AS order_status FROM ordered_products INNER JOIN `orders` ON ordered_products.orderid =orders.id LEFT JOIN clients ON orders.customerid = clients.id WHERE `vendorid` = ".Auth::user()->id.$query." and orders.customerid in ($userString)";
				}
				else{
					$orders = "SELECT *,ordered_products.status  as status, orders.status AS order_status FROM ordered_products INNER JOIN `orders` ON ordered_products.orderid =orders.id LEFT JOIN clients ON orders.customerid = clients.id WHERE `vendorid` = ".Auth::user()->id.$query." and orders.customerid = 0 ";
				}					
			}
			else{
				$orders = "SELECT *,ordered_products.status, orders.status AS order_status  FROM ordered_products INNER JOIN `orders` ON ordered_products.orderid =orders.id LEFT JOIN clients ON orders.customerid = clients.id WHERE `vendorid` = ".Auth::user()->id.$query;
			}
			 
			$orders = DB::select(DB::raw($orders));
			
            foreach ($orders as $customer) {

                if (!empty($customer->first_name)) {
                    $temp = [];
                    $temp[0] = $customer->first_name . " " . $customer->last_name;
                            $temp[1] = (string)$customer->latitude;
                            $temp[2] = (string)$customer->longitude;
                            $temp[3] = $customer->address;
                            $temp[4] = $customer->email;
                            $temp[5] = $customer->phone;
                            $temp[6] = (string)$customer->orderid;
                            $temp[7] = (string)(date('M d, Y', strtotime($customer->created_at)));
                            $temp[8] = '$ ' . $customer->cost;
                            $temp[9] = $customer->order_status;
                            $temp[10] = $customer->payment == 'completed' ? 'Paid' : ($customer->payment == 'pending' ? 'Not Paid' : 'Partial Paid');

                    $customer_array[] = $temp;

                } else {
                    continue;
                }
            }
			
    	}
		else{

			$orders = DB::table('ordered_products')->select(DB::raw('distinct orderid,status'))->where('vendorid',43)->get();

			//rderedProducts::select('distinct')->where('vendorid',43)->orderBy('id','desc')->get()->unique();
			OrderedProducts::select('orders.status AS order_status','ordered_products.created_at AS order_created_at','clients.*','ordered_products.orderid')->where('ordered_products.vendorid',43)->orderBy('ordered_products.id','desc')
			->join('orders','ordered_products.orderid','=','orders.id')
			->leftjoin('clients','orders.customerid','=','clients.id')
			->chunk(500, function ($rows) use(&$customer_array) {

				foreach ($rows as $customer) {

					if (!empty($customer->first_name)) {
						$created_date = date('M d, Y', strtotime($customer->order_created_at));
						$temp = [];
						$temp[0] = $customer->first_name . " " . $customer->last_name;
						$temp[1] = (string)$customer->latitude;
						$temp[2] = (string)$customer->longitude;
						$temp[3] = $customer->address;
						$temp[4] = $customer->email;
						$temp[5] = $customer->phone;
						$temp[6] = (string)$customer->orderid;
						$temp[7] = (string)$created_date;
						$temp[8] = '$ ' . $customer->cost;
						$temp[9] = $customer->order_status;
						$temp[10] = $customer->payment == 'completed' ? 'Paid' : ($customer->payment == 'pending' ? 'Not Paid' : 'Partial Paid');

						$customer_array[] = $temp;

					} else {
						continue;
					}

				}
			});

        }


        $customer_array = json_encode($customer_array);



        return view('vendor.orderlist',compact('orders','customer_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function status($id,$status)
    {
        $order = OrderedProducts::findOrFail($id);
        $stat['status'] = $status;
        $order->update($stat);
        return redirect('vendor/orders')->with('message','Order Status Updated Successfully');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
