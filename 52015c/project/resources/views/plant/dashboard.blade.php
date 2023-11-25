<?php
use App\Order;
use App\OrderedProducts;
use Illuminate\Support\Facades\DB;

$fullUrlCurrent = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$status = array(
    'pending'=>0,
    'in_transit'=>0,
    'at_plan_rece'=>0,
    'at_plan_com'=>0,
    'on_deliver'=>0,
    'completed_deliver'=>0,
    'completed_in_store'=>0,
);
$startTime = date('Y-m-d 00:00:00');
$endTime = date('Y-m-d 23:59:59');

$urlTime = "";

if(isset($_GET['time'])){
    $urlTime = $_GET['time'];
    switch ($_GET['time']) {
        case 'week':
            $startTime = date('Y-m-d 00:00:00',strtotime('this week'));
            break;
        case 'month':
            $startTime = date('Y-m-01 00:00:00',strtotime('this month'));
            break;
        case 'year':
            $startTime = date('Y-m-d 00:00:00',strtotime('first day of January '.date('Y')));
            break;
        case 'all':
            $startTime = date('Y-m-d 00:00:00',strtotime('first day of January 1970'));
            break;
    }
}else{
    header("Location: ".$fullUrlCurrent."?time=all");exit;
}


$SaleSummary = DB::table('ordered_products')->where('vendorid',Auth::user()->id)->where('created_at','>=',$startTime)->where('created_at','<=',$endTime)->sum("cost");

$allOrders = DB::table('ordered_products')->where('vendorid',Auth::user()->id)->where('created_at','>=',$startTime)->where('created_at','<=',$endTime)->get();
if($allOrders!=null){
    foreach ($allOrders as $ordersData) {
        if($ordersData->status==Config::get('constants.PENDING_ORDER')){
            $status['pending'] = $status['pending']+1;
        }elseif($ordersData->status==Config::get('constants.IN_TRANSIT')){
            $status['in_transit'] = $status['in_transit']+1;
        }elseif($ordersData->status==Config::get('constants.AT_PLANT_RECE')){
            $status['at_plan_rece'] = $status['at_plan_rece']+1;
        }elseif($ordersData->status==Config::get('constants.AT_PLANT_COMPLETE')){
            $status['at_plan_com'] = $status['at_plan_com']+1;
        }elseif($ordersData->status==Config::get('constants.ON_DELIVERY')){
            $status['on_deliver'] = $status['on_deliver']+1;
        }elseif($ordersData->status==Config::get('constants.COMPLETED_DELIVERY')){
            $status['completed_deliver'] = $status['completed_deliver']+1;
        }else{
            $status['completed_in_store'] = $status['completed_in_store']+1;
        }
    }
}


$orderCompletedSort = "";
$orderTransitSort = "";

if(isset($_GET['order_completed']) && $_GET['order_completed']!=""){
    $orderCompletedSort = $_GET['order_completed'];
}
if(isset($_GET['order_transit']) && $_GET['order_transit']!=""){
    $orderTransitSort = $_GET['order_transit'];
}



?>
@extends('plant.includes.master-plant')

@section('content')

<style>
    div.dataTables_wrapper div.dataTables_filter input
    {
        margin-right:0px;
    }
    .form-control.title-select{
        color:#fff;
    }
</style>
<div class="row">
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('message') }}
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('error') }}
    </div>
    @endif
</div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 left-table">
        <div class="row">
            <div class="bg-white">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <form action="{!! url('vendor/action/request-pickup') !!}" method="post">
                            {{csrf_field()}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="top-title">
                                        <h3>Orders In Transit</h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table cellpadding="0" cellspacing="0" id="table_1" class="table table-striped table-bordered data-table">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px"></th>
                                                <th>Ship Date</th>
                                                <th>Order#</th>
                                                <th>QTY</th>
                                                <th>Clients</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox"></td>
                                                    <td>May 10 2019</td>
                                                    <td>11</td>
                                                    <td>1</td>
                                                    <td>John Test</td>
                                                    <td>In Transit</td>
                                                </tr>

                                            <?php
                                           /* $pendingOrders = OrderedProducts::where('vendorid',Auth::user()->id)->where('status',Config::get('constants.PENDING_ORDER'))->where('created_at','>=',$startTime)->where('created_at','<=',$endTime)->limit(30)->orderBy('id','desc')->get();
                                            if(count($pendingOrders)>0){
                                                foreach ($pendingOrders as $orders) {
                                                    $getOtherDetails = DB::select('SELECT * FROM `clients` WHERE id = (SELECT `customerid` FROM `orders` WHERE `id` = ?) ',[$orders->orderid]);
                                                    if($getOtherDetails!=null){
                                                        $getOtherDetails = $getOtherDetails[0];
                                                        $statusKey = "constants.status_".$orders->status;
                                                        */?><!--
                                                        <tr>
                                                            <td align="center">
                                                                <div class="checkbox-new">
                                                                    <input value="<?/*=$orders->id*/?>" class="float-left" id="order_pro_<?/*=$orders->id*/?>" name="order.product[]" type="checkbox">
                                                                    <label for="order_pro_<?/*=$orders->id*/?>" class="float-left font_size_14"></label>
                                                                </div>
                                                            </td>
                                                            <td><a href="{!! url('vendor/details/'.$orders->orderid) !!}"><?/*=$orders->orderid*/?></a></td>

                                                            <td><a href="{!! url('vendor/profile/'.$getOtherDetails->id) !!}"><?/*=$getOtherDetails->name*/?></a></td>
                                                            <td><?/*=Config::get($statusKey)*/?></td>
                                                            <td><?/*=date('M d, Y',strtotime($orders->created_at))*/?></td>
                                                        </tr>
                                                        --><?php
/*                                                    }
                                                }
                                            }else{
                                                echo '<td colspan="5" style="text-align:center">No Results Found</td>';
                                            }*/
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-btn text-right">
                                        <ul class="table-foot-btn">
                                            <li><a href="{!! url('vendor/vieworders/active') !!}">View All</a></li>
                                            <li class="selectUnchecked"><a href="javascript:;">Select All</a></li>
                                            <li class="deselectChecked hide"><a href="javascript:;">Deselect</a></li>
                                            <li><button type="submit" name="submit" value="request_pickup">Request Plant Pickup</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 col-xs-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="top-title">
                                    <h3>Items At Plant</h3>
                                </div>
                                <form method="get" action="<?=$fullUrlCurrent?>" id="filterModelTraOrders">
                                    <input type="hidden" value="<?=$urlTime?>" name="time">
                                    <select name="order_transit" class="form-control title-select" onchange="document.getElementById('filterModelTraOrders').submit();" >
                                        <option value="" selected="">All</option>
                                        <option <?php if($orderTransitSort==Config::get('constants.IN_TRANSIT')){echo 'selected';} ?> value="<?=Config::get('constants.IN_TRANSIT')?>">In Transit</option>

                                        <?php /* ?>

											<option <?php if($orderTransitSort==Config::get('constants.AT_PLANT_RECE')){echo 'selected';} ?> value="<?=Config::get('constants.AT_PLANT_RECE')?>">Plant - Received</option>
											<option <?php if($orderTransitSort==Config::get('constants.AT_PLANT_COMPLETE')){echo 'selected';} ?> value="<?=Config::get('constants.AT_PLANT_COMPLETE')?>">Plant - Completed</option>
												<?php */ ?>

                                        <option <?php if($orderTransitSort==Config::get('constants.ON_DELIVERY')){echo 'selected';} ?> value="<?=Config::get('constants.ON_DELIVERY')?>">On Delivery</option>
                                    </select>
                                </form>
                            </div>

                            <form action="{!! url('vendor/action/batch-notify') !!}" method="post">
                                {{csrf_field()}}

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table cellpadding="0" cellspacing="0" id="table_2" class="table table-striped table-bordered data-table">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px"></th>
                                                <th>Received Date</th>
                                                <th>Order#</th>
                                                <th>QTY</th>
                                                <th>Clients</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>May 10 2019</td>
                                                <td>11</td>
                                                <td>1</td>
                                                <td>John Test</td>
                                                <td>In Transit</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>May 10 2019</td>
                                                <td>11</td>
                                                <td>1</td>
                                                <td>John Test</td>
                                                <td>In Transit</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>May 10 2019</td>
                                                <td>11</td>
                                                <td>1</td>
                                                <td>John Test</td>
                                                <td>In Transit</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>May 10 2019</td>
                                                <td>11</td>
                                                <td>1</td>
                                                <td>John Test</td>
                                                <td>In Transit</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>May 10 2019</td>
                                                <td>11</td>
                                                <td>1</td>
                                                <td>John Test</td>
                                                <td>In Transit</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>May 10 2019</td>
                                                <td>11</td>
                                                <td>1</td>
                                                <td>John Test</td>
                                                <td>In Transit</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>May 10 2019</td>
                                                <td>12</td>
                                                <td>1</td>
                                                <td>John Test</td>
                                                <td>In Transit</td>
                                            </tr> <tr>
                                                <td><input type="checkbox"></td>
                                                <td>May 10 2019</td>
                                                <td>13</td>
                                                <td>1</td>
                                                <td>John Test</td>
                                                <td>In Transit</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>May 10 2019</td>
                                                <td>11</td>
                                                <td>1</td>
                                                <td>John Test</td>
                                                <td>In Transit</td>
                                            </tr>


                                            <?php
                                            /*arrayOfTrnasit = array(Config::get('constants.IN_TRANSIT'),Config::get('constants.ON_DELIVERY'));
                                            $commaSepratedString = implode(',', $arrayOfTrnasit);
                                            if($orderTransitSort!=""){
                                                $commaSepratedString = $orderTransitSort;
                                            }
                                            $pendingOrders = DB::select('SELECT * FROM `ordered_products` WHERE vendorid = '.Auth::user()->id.' and status IN ('.$commaSepratedString.') and created_at >= "'.$startTime.'" and created_at <= "'.$endTime.'" ORDER BY id desc LIMIT 30 ');
                                            if(count($pendingOrders)>0){
                                                foreach ($pendingOrders as $orders) {
                                                    $getOtherDetails = DB::select('SELECT * FROM `clients` WHERE id = (SELECT `customerid` FROM `orders` WHERE `id` = ?) ',[$orders->orderid]);
                                                    if($getOtherDetails!=null){
                                                        $getOtherDetails = $getOtherDetails[0];
                                                        $statusKey = "constants.status_".$orders->status;
                                                        */?><!--
                                                        <tr>
                                                            <td align="center">
                                                                <div class="checkbox-new">
                                                                    <input value="<?/*=$orders->id*/?>" class="float-left" id="order_pro_<?/*=$orders->id*/?>" name="order.product[]" type="checkbox">
                                                                    <label for="order_pro_<?/*=$orders->id*/?>" class="float-left font_size_14"></label>
                                                                </div>
                                                            </td>
                                                            <td><a href="{!! url('vendor/details/'.$orders->orderid) !!}"><?/*=$orders->orderid*/?></a></td>
                                                            <td><a href="{!! url('vendor/profile/'.$getOtherDetails->id) !!}"><?/*=$getOtherDetails->name*/?></a></td>
                                                            <td><?/*=Config::get($statusKey)*/?></td>
                                                            <td><?/*=date('M d, Y',strtotime($orders->created_at))*/?></td>
                                                        </tr>
                                                        --><?php
/*                                                    }
                                                }
                                            }else{
                                                echo '<td colspan="5" style="text-align:center">No Results Found</td>';
                                            }*/
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-btn text-right">
                                        <ul class="table-foot-btn">
                                            <li><a href="{!! url('vendor/vieworders/in-transit') !!}">View All</a></li>
                                            <li class="selectUnchecked"><a href="javascript:;">Select All</a></li>
                                            <li class="deselectChecked hide"><a href="javascript:;">Deselect</a></li>
                                            <li><button type="submit" name="submit" value="notify_client">Notify Client</button></li>
                                        </ul>
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="top-title">
                                    <h3>Orders On Delivery</h3>
                                </div>
                                <form method="get" action="<?=$fullUrlCurrent?>" id="filterModelCompleOrders">
                                    <input type="hidden" value="<?=$urlTime?>" name="time">
                                    <select name="order_completed" class="form-control title-select" onchange="document.getElementById('filterModelCompleOrders').submit();" >
                                        <option value="" selected="">All</option>
                                        <option <?php if($orderCompletedSort==Config::get('constants.COMPLETED_IN_STORE')){echo 'selected';} ?> value="<?=Config::get('constants.COMPLETED_IN_STORE')?>">Completed - In Store</option>
                                        <option <?php if($orderCompletedSort==Config::get('constants.COMPLETED_DELIVERY')){echo 'selected';} ?> value="<?=Config::get('constants.COMPLETED_DELIVERY')?>">Completed - Delivered</option>
                                    </select>
                                </form>
                            </div>
                            <form action="{!! url('vendor/action/batch-notify') !!}" method="post">
                                {{csrf_field()}}
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table cellpadding="0" cellspacing="0" id="table_3" class="table table-striped table-bordered data-table">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px"></th>
                                                <th>Complete Date</th>
                                                <th>Order#</th>
                                                <th>Client</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            /*$arrayOfTrnasit = array(Config::get('constants.COMPLETED_DELIVERY'),Config::get('constants.COMPLETED_IN_STORE'));
                                            $commaSepratedString = implode(',', $arrayOfTrnasit);
                                            if($orderCompletedSort!=""){
                                                $commaSepratedString = $orderCompletedSort;
                                            }
                                            $pendingOrders = DB::select('SELECT * FROM `ordered_products` WHERE vendorid = '.Auth::user()->id.' and status IN ('.$commaSepratedString.') and created_at >= "'.$startTime.'" and created_at <= "'.$endTime.'" ORDER BY id desc LIMIT 30');
                                            if(count($pendingOrders)>0){
                                                foreach ($pendingOrders as $orders) {
                                                    $getOtherDetails = DB::select('SELECT * FROM `clients` WHERE id = (SELECT `customerid` FROM `orders` WHERE `id` = ?) ',[$orders->orderid]);
                                                    if($getOtherDetails!=null){
                                                        $getOtherDetails = $getOtherDetails[0];
                                                        $statusKey = "constants.status_".$orders->status;
                                                        */?><!--
                                                        <tr>
                                                            <td align="center">
                                                                <div class="checkbox-new">
                                                                    <input value="<?/*=$orders->id*/?>" class="float-left" id="order_pro_<?/*=$orders->id*/?>" name="order.product[]" type="checkbox">
                                                                    <label for="order_pro_<?/*=$orders->id*/?>" class="float-left font_size_14"></label>
                                                                </div>
                                                            </td>
                                                            <td><?/*=date('M d, Y',strtotime($orders->updated_at))*/?></td>
                                                            <td><a href="{!! url('vendor/details/'.$orders->orderid) !!}"><?/*=$orders->orderid*/?></a></td>
                                                            <td><a href=" {!! url('vendor/profile/'.$getOtherDetails->id) !!}"><?/*=$getOtherDetails->name*/?></a></td>

                                                            <td><?/*=Config::get($statusKey)*/?></td>
                                                            <td><a href="#">SMS</a> | <a href="{!! url('vendor/action/send-notification') !!}?id=<?/*=$orders->id*/?>">Email</a></td>
                                                        </tr>
                                                        --><?php
/*                                                    }
                                                }
                                            }else{
                                                echo '<td colspan="6" style="text-align:center">No Results Found</td>';
                                            }*/
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-btn text-right">
                                        <ul class="table-foot-btn">
                                            <li><a href="{!! url('vendor/vieworders/completed') !!}">View All</a></li>
                                            <li class="selectUnchecked"><a href="javascript:;">Select All</a></li>
                                            <li class="deselectChecked hide"><a href="javascript:;">Deselect</a></li>
                                            <li><button type="submit" name="submit" value="notify_client">Batch Notify</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="NotifyEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Notify Client</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Select which method you want to choose to notify your clients.</p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-success" value="Email">
                    <input type="submit" class="btn btn-primary" value="SMS">
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('footer')

@stop