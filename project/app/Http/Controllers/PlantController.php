<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Vendors;
use App\Withdraw;
use App\Order;
use App\OrderedProducts;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PlantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:plant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plant.dashboard');
    }

    public function vieworders($status)
    {
        $orders = array();
        $searchSort = "";
        $text = "All Orders";
        $filterStatus = array();
        $q = "";
        if(isset($_GET['q']) && $_GET['q']!=""){
            $q = $searchSort = $_GET['q'];
        }
        switch ($status) {
            case 'active':
                $orders = OrderedProducts::where('vendorid',Auth::user()->id)->where('status',config('constants.PENDING_ORDER'))->limit(30)->orderBy('id','desc')->get();
                $text = "Active Orders";
                break;
            case 'in-transit':
                $text = "In-Transit Orders";
                $arrayOfTrnasit = array(config('constants.IN_TRANSIT'),config('constants.AT_PLANT_RECE'),config('constants.AT_PLANT_COMPLETE'),config('constants.ON_DELIVERY'));
                $filterStatus = $arrayOfTrnasit;
                $commaSepratedString = implode(',', $arrayOfTrnasit);
                if($searchSort!=""){
                    $commaSepratedString = $searchSort;
                }
                $orders = DB::select('SELECT * FROM `ordered_products` WHERE vendorid = '.Auth::user()->id.' and status IN ('.$commaSepratedString.')');
                break;
            case 'completed':
                $text = "Completed Orders";
                $arrayOfTrnasit = array(config('constants.COMPLETED_DELIVERY'),config('constants.COMPLETED_IN_STORE'));
                $filterStatus = $arrayOfTrnasit;
                $commaSepratedString = implode(',', $arrayOfTrnasit);
                if($searchSort!=""){
                    $commaSepratedString = $searchSort;
                }
                $orders = DB::select('SELECT * FROM `ordered_products` WHERE vendorid = '.Auth::user()->id.' and status IN ('.$commaSepratedString.')');
                break;
        }
        return view('vendor.vieworders',compact('orders','text','filterStatus','q'));
    }




    public function profile($id)
    {
        $orders = array();
        $searchSort = "";
        $text = "User Profile";
        $filterStatus = array();
        $q = "";
        $totalOrders=array();
        $orderIds=[];

        /*echo Auth::user()->id.' - '.$id;
        die;*/
        $vendorId=Auth::user()->id;

        $userDetails=DB::select("select * from clients where id='$id'");
        $orderids=DB::select("select * from orders where customerid='$id'");
        if($orderids!=null){
            foreach($orderids as $single){
                $orders[]=$single->id;
            }
            $orderIdsString=implode(',', $orders);
            //$totalOrders=DB::select("select * from orders where customerid='$id'");

            $users=DB::select("select * from ordered_products where vendorid='$vendorId' group by orderid");
            if($users!=null){
                foreach($users as $user){
                    $orderIds[]=$user->orderid;
                }
            }
            if(count($orderids)>0){
                $orderIdsStr=implode(',', $orderIds);


                $totalOrders=DB::select("select * from orders where id in ($orderIdsStr) and customerid='$id'");


            }

            //$totalOrders=DB::select("select * from ordered_products where vendorid='$vendorId' and orderid in ($orderIdsString)");
        }

        //$orders = OrderedProducts::where('vendorid',Auth::user()->id)->where('status',config('constants.PENDING_ORDER'))->limit(30)->orderBy('id','desc')->get();

        //$userDetails = DB::select("");

        return view('vendor.profile',compact('userDetails','totalOrders'));
    }


    public function withdraw()
    {
        //$countries = Country::all();
        $user = Vendors::findOrFail(Auth::user()->id);
        return view('vendor.withdrawmoney',compact('user','countries'));
    }

    public function details($id)
    {
        $order=Order::findOrFail($id);
        if($order!=null){

        }
        $model=DB::select("select * from ordered_products where orderid='$id'");
        return view('vendor.details',compact('model','order'));
    }


    public function withdraws()
    {
        if(isset($_GET['earningbtn'])){
            $query="";

            if(isset($_GET['orderId']) && $_GET['orderId']!=""){
                $query.=" and orderid='".$_GET['orderId']."'";
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

                $query.=" and  created_at>='".$startTime."' and created_at<='".$endTime."'";
            }
            else{


                if(isset($_GET['fromTime']) && $_GET['fromTime']!=""){
                    $query.=" and  created_at>='".date('Y-m-d 00:00:00',strtotime($_GET['fromTime']))."'";
                }

                if(isset($_GET['toTime']) && $_GET['toTime']!=""){
                    $query.=" and  created_at<='".date('Y-m-d 23:59:59',strtotime($_GET['toTime']))."'";
                }

            }
            if(isset($_GET['process']) && $_GET['process']!=""){
                $query.=" and  status='".$_GET['process']."'";
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
                    $sqlQuery = "SELECT * FROM ordered_products INNER JOIN `orders` ON ordered_products.orderid =orders.id WHERE `vendorid` = ".Auth::user()->id." and `paid` = 'yes' ".$query." and orders.customerid in ($userString)";
                }
                else{
                    $sqlQuery = "SELECT * FROM ordered_products INNER JOIN `orders` ON ordered_products.orderid =orders.id WHERE `vendorid` = ".Auth::user()->id." and `paid` = 'yes' ".$query." and orders.customerid = 0 ";
                }
            }
            else{
                $sqlQuery = "SELECT * FROM ordered_products INNER JOIN `orders` ON ordered_products.orderid =orders.id WHERE `vendorid` = ".Auth::user()->id." and `paid` = 'yes' ".$query;
            }

            $earnings = DB::select(DB::raw($sqlQuery));

        }
        else if(isset($_GET['sideTime']) && $_GET['sideTime']!=""){
            $startTime = date('Y-m-d 00:00:00');
            $endTime = date('Y-m-d 23:59:59');
            if(isset($_GET['sideTime'])){
                switch ($_GET['sideTime']) {
                    case 'week':
                        $startTime = date('Y-m-d 00:00:00',strtotime('this week'));
                        break;
                    case 'month':
                        $startTime = date('Y-m-d 00:00:00',strtotime('this month'));
                        break;
                    case 'year':
                        $startTime = date('Y-m-d 00:00:00',strtotime('first day of January '.date('Y')));
                        break;
                    case 'all':
                        $startTime = date('Y-m-d 00:00:00',strtotime('first day of January 1970'));
                        break;
                }
            }
            $sqlQuery = "SELECT * FROM ordered_products INNER JOIN `orders` ON ordered_products.orderid = orders.id WHERE `vendorid` = ".Auth::user()->id." and `paid` = 'yes'  and  created_at>='".$startTime."' and created_at<='".$endTime."'";
            $earnings = DB::select(DB::raw($sqlQuery));
        }
        else{
            $sqlQuery = "SELECT * FROM ordered_products INNER JOIN `orders` ON ordered_products.orderid = orders.id WHERE `vendorid` = ".Auth::user()->id." and `paid` = 'yes'";
            $earnings = DB::select(DB::raw($sqlQuery));
        }

        if(isset($_GET['historybtn'])){
            $query="";
            if(isset($_GET['ref']) && $_GET['ref']!=""){
                $query.=" and reference like '%".$_GET['ref']."%'";
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

                $query.=" and  created_at>='".$startTime."' and created_at<='".$endTime."'";
            }
            else{


                if(isset($_GET['fromTime']) && $_GET['fromTime']!=""){
                    $query.=" and  created_at>='".date('Y-m-d 00:00:00',strtotime($_GET['fromTime']))."'";
                }

                if(isset($_GET['toTime']) && $_GET['toTime']!=""){
                    $query.=" and  created_at<='".date('Y-m-d 23:59:59',strtotime($_GET['toTime']))."'";
                }

            }

            $getHistory = DB::select('SELECT * FROM `withdraws` WHERE vendorid = '.Auth::user()->id.$query);
        }
        else{
            $getHistory = DB::select('SELECT * FROM `withdraws` WHERE vendorid = '.Auth::user()->id);
        }



        $withdraws = Withdraw::where('vendorid',Auth::user()->id)->orderBy('id','desc')->get();

        return view('vendor.withdraws',compact('withdraws','earnings','getHistory'));
    }

    public function customers()
    {
        $query="";

        if(isset($_GET['name']) && $_GET['name']!=""){
            $query.="  name like '%".$_GET['name']."%' ";
        }

        if(isset($_GET['phone']) && $_GET['phone']!=""){
            if($query!=""){
                $query.=" and ";
            }
            $query.="  phone like '%".$_GET['phone']."%' ";
        }

        if(isset($_GET['email']) && $_GET['email']!=""){
            if($query!=""){
                $query.=" and ";
            }
            $query.="  email like '%".$_GET['email']."%' ";
        }

        if(isset($_GET['city']) && $_GET['city']!=""){
            if($query!=""){
                $query.=" and ";
            }
            $query.="  city = '".$_GET['city']."' ";
        }

        if(isset($_GET['zip']) && $_GET['zip']!=""){
            if($query!=""){
                $query.=" and ";
            }
            $query.="  zip like '%".$_GET['zip']."%' ";
        }

        if($query!=""){

            $new="select * from clients where ".$query;
            $data=DB::select(DB::raw($new));
            $idString="";
            $ids=array();
            if($data!=null){

                foreach($data as $single){
                    $ids[]=$single->id;
                }
                $idString=implode(',', $ids);
            }

            if($idString!=""){
                $query="SELECT * FROM `orders` WHERE `products` IN (select id from products WHERE vendorid=".Auth::user()->id.") and `customerid` IN (".$idString.") group by customerid";
            }
            else{
                $query="SELECT * FROM `orders` WHERE `products` IN (select id from products WHERE vendorid=".Auth::user()->id.") and `customerid`=0 group by customerid";
            }

        }
        else{
            $query="SELECT * FROM `orders` WHERE `products` IN (select id from products WHERE vendorid=".Auth::user()->id.") group by customerid";
        }


        $customers = DB::select(DB::raw($query));



        if(isset($_POST['task']) && $_POST['task']=="email"){

            $ids=explode(',', $_POST['customerId']);
            if(count($ids)>0){
                foreach($ids as $id){
                    $userDetails = DB::select(DB::raw("select * from clients where id='".$id."'"));

                    mail($userDetails[0]->email,$_POST['subject'],$_POST['message'],'dryclean_dev2@kgyr-nfwh.accessdomain.com');
                }
                Session::flash('message', 'Email sent successfully.');
            }
        }

        return view('vendor.customers',compact('customers'));
    }

    public function pos()
    {
        //$products=Product::where('vendorid',Auth::user()->id)->orderBy('id','desc')->get();
        $query="";

        if(isset($_GET['product']) && $_GET['product']!=""){
            $query.=" and title like '%".$_GET['product']."%' ";
        }

        if(isset($_GET['category']) && $_GET['category']!=""){
            $query.=" and category like '%".$_GET['category'].",%' ";
        }

        if(isset($_GET['status']) && $_GET['status']!=""){
            $query.=" and status = '".$_GET['status']."' ";
        }

        if($query!=""){
            $query="SELECT * FROM `products` WHERE `vendorid`=".Auth::user()->id." ".$query." order by id desc";
        }
        else{
            $query="SELECT * FROM `products` WHERE `vendorid`=".Auth::user()->id." order by id desc";
        }

        $products = DB::select(DB::raw($query));
        return view('vendor.pos',compact('products'));
    }

    public function plant()
    {

        $param="";
        $s='';
        if(isset($_GET['order'])){
            if(isset($_GET['status']) && $_GET['status']!=""){
                //$param.=" status = '".$_GET['status']."' ";
                $s=" status = '".$_GET['status']."' ";
            }
            else{
                $s="status in (3,4)";
            }
            if(isset($_GET['time']) && $_GET['time']!=""){

                $setttleDate = explode('-', $_GET['time']);
                $dateFiltered =  $setttleDate[0]."/".$setttleDate[1]."/".$setttleDate[2];

                $param.=" and  created_at>='".date('Y-m-d 00:00:00',strtotime($dateFiltered))."' and created_at <= '".date('Y-m-d 23:59:59',strtotime($dateFiltered))."'";
            }
            if($param!=""){

                $query="SELECT * FROM `ordered_products` WHERE `vendorid`=".Auth::user()->id." and ".$s." ".$param." order by id desc";
            }
            else{
                $query="SELECT * FROM `ordered_products` WHERE `vendorid`=".Auth::user()->id." and ".$s." order by id desc";
            }

        }
        else{
            $query="SELECT * FROM `ordered_products` WHERE `vendorid`=".Auth::user()->id." and status in (3,4) order by id desc";
        }

        // //echo $query;die;

        $orders = DB::select(DB::raw($query));


        $param2="";
        $s2='';
        if(isset($_GET['order2'])){
            if(isset($_GET['status']) && $_GET['status']!=""){
                //$param.=" status = '".$_GET['status']."' ";
                $s2=" status = '".$_GET['status']."' ";
            }
            else{
                $s2="status in (2,5,6)";
            }
            if(isset($_GET['time']) && $_GET['time']!=""){
                $setttleDate = explode('-', $_GET['time']);
                $dateFiltered =  $setttleDate[0]."/".$setttleDate[1]."/".$setttleDate[2];
                $param2.=" and  created_at>='".date('Y-m-d 00:00:00',strtotime($dateFiltered))."' and created_at<='".date('Y-m-d 23:59:59',strtotime($dateFiltered))."'";
            }
            if($param2!=""){

                $query2="SELECT * FROM `ordered_products` WHERE `vendorid`=".Auth::user()->id." and ".$s2." ".$param2." order by id desc";
            }
            else{
                $query2="SELECT * FROM `ordered_products` WHERE `vendorid`=".Auth::user()->id." and ".$s2." order by id desc";
            }

        }
        else{
            $query2="SELECT * FROM `ordered_products` WHERE `vendorid`=".Auth::user()->id." and status in (2,5,6) order by id desc";
        }



        $orders2 = DB::select(DB::raw($query2));
        return view('vendor.plant',compact('orders','orders2'));
    }


    public function withdrawsubmit(Request $request)
    {
        $from = Vendors::findOrFail(Auth::user()->id);

        $withdrawcharge = Settings::findOrFail(1);
        $charge = $withdrawcharge->withdraw_fee;

        if($request->amount > 0){

            $amount = $request->amount;

            if ($from->current_balance >= $amount){
                $fee = (($withdrawcharge->withdraw_charge / 100) * $amount) + $charge;
                $finalamount = $amount - $fee;
                $finalamount = number_format((float)$finalamount,2,'.','');

                $balance1['current_balance'] = $from->current_balance - $amount;
                $from->update($balance1);

                $newwithdraw = new Withdraw();
                $newwithdraw['vendorid'] = Auth::user()->id;
                $newwithdraw['method'] = $request->methods;
                $newwithdraw['acc_email'] = $request->acc_email;
                $newwithdraw['iban'] = $request->iban;
                $newwithdraw['country'] = $request->acc_country;
                $newwithdraw['acc_name'] = $request->acc_name;
                $newwithdraw['address'] = $request->address;
                $newwithdraw['swift'] = $request->swift;
                $newwithdraw['reference'] = $request->reference;
                $newwithdraw['amount'] = $finalamount;
                $newwithdraw['fee'] = $fee;
                $newwithdraw->save();

                return redirect()->back()->with('message','Withdraw Request Sent Successfully.');

            }else{
                return redirect()->back()->with('error','Insufficient Balance.')->withInput();
            }
        }
        return redirect()->back()->with('error','Please enter a valid amount.')->withInput();
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
