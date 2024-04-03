@extends('vendor.includes.master-vendor')

@section('content')

    <div class="page-title">
        <h2>Plant Facilities</h2>
    </div>
    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif

    <style>
        .form-control {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        }

        .custom-dateicker {
            float: right;
            width: 26%;
            margin: -5px 12px 0 0px;
        }

        select.form-control.title-select {
            display: inline-block;
            width: 21%;
            float: right;
            border-radius: 0;
            height: 30px;
            padding: 3px 4px;
            font-size: 12px;
            margin: -5px 0 0 0;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
            <div class="bg-white">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="top-title">
                            <h3>Items At Plant</h3>
                        </div>
                        <form action="" method="get">
                            <select class="form-control title-select" onchange="$(this).parents('form').submit();"
                                name="status" style="margin-top:-28px;background:#fff;position: unset;">
                                <option value="">Status</option>
                                <option <?php if (isset($_GET['order'])) {
                                    if (isset($_GET['status'])) {
                                        if ($_GET['status'] == 3) {
                                            echo 'selected=""';
                                        }
                                    }
                                } ?> value="3">At Plant - Received</option>
                                <option <?php if (isset($_GET['order'])) {
                                    if (isset($_GET['status'])) {
                                        if ($_GET['status'] == 4) {
                                            echo 'selected=""';
                                        }
                                    }
                                } ?> value="4">At Plant - Completed</option>
                            </select>
                            <div id="conta1" class="custom-dateicker" style="margin-top:-35px; padding-right:15px;">
                                <label class="subtitle" style="color:#fff;padding-top: 7px;">Received Date</label>
                                <div id="datepicker" class="input-group date custom-calendar datepicker"
                                    data-date-format="mm-dd-yyyy">
                                    <input class="form-control " value="<?php if (isset($_GET['order'])) {
                                        if (isset($_GET['time'])) {
                                            echo $_GET['time'];
                                        }
                                    } ?>" name="time"
                                        type="text" />
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <input type="hidden" name="order" value="order" style="display:none;">
                        </form>
                    </div>
                    <form action="{!! url('vendor/action/batch-notify') !!}" method="post">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="table-responsive" style="width:100%;">
                                <table cellpadding="0" cellspacing="0" id="table_1"
                                    class="table table-bordered table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th width="5%"></th>
                                            <th class="hidden-xs hidden-sm">
                                                <center>Received Date</center>
                                            </th>
                                            <th>
                                                <center><a href="#">Order#</a></center>
                                            </th>
                                            <th class="hidden-xs hidden-sm">
                                                <center>QTY</center>
                                            </th>
                                            <th>
                                                <center><a href="#">Clients</a></center>
                                            </th>
                                            <th class="hidden-xs hidden-sm">
                                                <center>Status</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
								$totalOrders=$totalqty=0;
								if($orders!=null){
									
									foreach($orders as $order){
										$totalOrders++;
										$totalqty+=$order->quantity;
										?>
                                        <tr>
                                            <td align="center">
                                                <div class="checkbox-new">
                                                    <input value="<?= $order->id ?>" class="float-left"
                                                        id="order_pro_<?= $order->id ?>" name="order.product[]"
                                                        type="checkbox">
                                                    <label for="order_pro_<?= $order->id ?>"
                                                        class="float-left font_size_14"></label>
                                                </div>
                                            </td>
                                            <td class="hidden-xs hidden-sm"><?php echo date('M j, Y', strtotime($order->created_at)); ?></td>
                                            <!-- <td><a href="javascript:;"><?php //echo $order->orderid;
                                            ?></a></td> -->
                                            <td><a href="{!! url('vendor/details/' . $order->orderid) !!}"><?php echo $order->orderid; ?></a></td>
                                            <td class="hidden-xs hidden-sm"><?php echo $order->quantity; ?></td>
                                            <?php
                                            
                                            $getOtherDetails = DB::select('SELECT * FROM `clients` WHERE id = (SELECT `customerid` FROM `orders` WHERE `id` = ' . $order->orderid . ')');
                                            ?>
                                            <td><a href="{!! url('vendor/profile/' . $getOtherDetails[0]->id) !!}"><?= $getOtherDetails[0]->name ?></a></td>

                                            <td class="hidden-xs hidden-sm">
                                                <?= Config::get('constants.status_' . $order->status) ?></td>
                                        </tr>
                                        <?php
									}
								}
								?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-btn text-right">
                                <strong>
                                    <ul class="table-foot-btn">

                                        <li class="selectUnchecked"><a href="javascript:;">Select All</a></li>
                                        <li class="deselectChecked hide"><a href="javascript:;">Deselect</a></li>
                                        <li><button type="submit" name="submit" value="notify_client">Batch
                                                Notify</button></li>

                                        <li>Order: &nbsp;<?php echo $totalOrders; ?></li>
                                        <li>No. Of Items: &nbsp;<?php echo $totalqty; ?></li>

                                        <li><button type="submit" name="submit" value="mark_complete">Mark as
                                                Complete</button></li>
                                        <li><button type="submit" name="submit" value="request_delivery">Request
                                                Delivery</button></li>

                                    </ul>
                                </strong>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="top-title">
                            <h3>Orders on Delivery</h3>
                        </div>
                        <form action="" method="get">
                            <select class="form-control title-select" onchange="$(this).parents('form').submit();"
                                name="status" style="margin-top:-28px;background:#fff;position: unset;">
                                <option value="">Status</option>



                                <option <?php if (isset($_GET['order2'])) {
                                    if (isset($_GET['status'])) {
                                        if ($_GET['status'] == 2) {
                                            echo 'selected=""';
                                        }
                                    }
                                } ?> value="2">In Transit</option>
                                <option <?php if (isset($_GET['order2'])) {
                                    if (isset($_GET['status'])) {
                                        if ($_GET['status'] == 5) {
                                            echo 'selected=""';
                                        }
                                    }
                                } ?> value="5">On Delivery</option>
                                <option <?php if (isset($_GET['order2'])) {
                                    if (isset($_GET['status'])) {
                                        if ($_GET['status'] == 6) {
                                            echo 'selected=""';
                                        }
                                    }
                                } ?> value="6">Completed Delivery</option>
                                <!--<option value="4">At Plant - Completed</option>-->


                            </select>
                            <div id="conta2" class="custom-dateicker" style="margin-top:-35px; padding-right:15px;">
                                <label class="subtitle" style="color:#fff;padding-top: 7px;">Ship Date</label>
                                <div id="datepicker2" class="input-group date custom-calendar datepicker"
                                    data-date-format="mm-dd-yyyy">
                                    <input class="form-control " value="<?php if (isset($_GET['order2'])) {
                                        if (isset($_GET['time'])) {
                                            echo $_GET['time'];
                                        }
                                    } ?>" name="time"
                                        type="text" />
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            <input type="hidden" name="order2" style="display: none;">
                        </form>
                    </div>
                    <form action="{!! url('vendor/action/batch-notify') !!}" method="post">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="table-responsive" style="width:100%;">
                                <table cellpadding="0" cellspacing="0" id="table_2"
                                    class="table table-bordered table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th width="5%"></th>
                                            <th class="hidden-xs hidden-sm">
                                                <center>Ship Date</center>
                                            </th>
                                            <th>
                                                <center><a href="#">Order#</a></center>
                                            </th>
                                            <th class="hidden-xs hidden-sm">
                                                <center>QTY</center>
                                            </th>
                                            <th>
                                                <center><a href="#">Clients</a></center>
                                            </th>
                                            <th class="hidden-xs hidden-sm">
                                                <center>Status</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
								$totalOrders2=$totalqty2=0;
								if($orders2!=null){
									
									foreach($orders2 as $order2){
										$totalOrders2++;
										$totalqty2+=$order2->quantity;   
										?>
                                        <tr>
                                            <td align="center">
                                                <div class="checkbox-new">
                                                    <input value="<?= $order2->id ?>" class="float-left"
                                                        id="order_pro_<?= $order2->id ?>" name="order.product[]"
                                                        type="checkbox">
                                                    <label for="order_pro_<?= $order2->id ?>"
                                                        class="float-left font_size_14"></label>
                                                </div>
                                            </td>
                                            <td class="hidden-xs hidden-sm"><?php echo date('M j, Y', strtotime($order2->created_at)); ?></td>
                                            <td><a href="{!! url('vendor/details/' . $order2->orderid) !!}"><?php echo $order2->orderid; ?></a></td>
                                            <td class="hidden-xs hidden-sm"><?php echo $order2->quantity; ?></td>
                                            <?php
											
											$getOtherDetails2 = DB::select('SELECT * FROM `clients` WHERE id = (SELECT `customerid` FROM `orders` WHERE `id` = '.$order2->orderid.')');
											if($getOtherDetails2!=null){
												?>

                                            <td><a href="{!! url('vendor/profile/' . $getOtherDetails2[0]->id) !!}"><?= $getOtherDetails2[0]->name ?></a>
                                            </td>
                                            <?php
											}
											?>
                                            <td class="hidden-xs hidden-sm">
                                                <?= Config::get('constants.status_' . $order2->status) ?></td>
                                        </tr>
                                        <?php
									}
								}
								?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-btn text-right">
                                <strong>
                                    <ul class="table-foot-btn">
                                        <li class="selectUnchecked"><a href="javascript:;">Select All</a></li>
                                        <li class="deselectChecked hide"><a href="javascript:;">Deselect</a></li>
                                        <li><button type="submit" name="submit" value="notify_client">Batch
                                                Notify</button></li>
                                        <li>Order: &nbsp;<?php echo $totalOrders2; ?></li>
                                        <li>No. Of Items: &nbsp;<?php echo $totalqty2; ?></li>
                                        <li><button type="submit" name="submit" value="mark_complete">Mark as
                                                Complete</button></li>
                                        <li><button type="submit" name="submit" value="request_delivery">Request
                                                Delivery</button></li>
                                    </ul>
                                </strong>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).on("change", ".custom-calendar .form-control", function() {
            $(this).closest("form").submit();
        });
    </script>

@stop

@section('footer')

@stop
