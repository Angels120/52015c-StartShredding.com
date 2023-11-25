
<?php $__env->startSection('title','Oder Details'); ?>
<?php $__env->startSection('content'); ?>
    <style>
        @media  print {
            body * {
                visibility: hidden;
            }

            .inner {
                display: none !important;
            }


            #print-btn {
                display: none !important;
            }

            #print * {
                visibility: visible;
            }
        }
    </style>
    <?php 
        $subtotal = 0;
        $getOrderProducts = DB::select("select * from ordered_products where orderid='$order->id'");
        if(is_array($getOrderProducts) && count($getOrderProducts)>0){
        foreach ($getOrderProducts as $orderDetails) {
        if($orderDetails!=null){
        $subtotal += $orderDetails->cost * $orderDetails->quantity;
        }
        }
        }
     ?>
    <!-- START PAGE CONTENT -->
    <div class="content ">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid">
            <!-- START card -->
            <div class="card card-default">
                <div class="card-header separator">
                    <div class="card-title">
                        <h5><strong>Order Details</strong></h5>

                    </div>
                </div>
                <div class="card-body p-t-20">
                    <!-- <div class="container-fluid"> -->
                    <div class="row">
                        <div class="col-md-7" id="print">
                            <div class="card card-default">
                                <div class="invoice padding-50 sm-padding-10">
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="all-caps text-center font-weight-bold">
                                                    <?php echo e($user['first_name']); ?> <?php echo e($user['last_name']); ?></h2>

                                                <address class="m-t-10 text-center">
                                                    <?php echo e($multiple_address->address); ?> <br>
                                                    <?php if(isset($user->unit_no)): ?>
                                                        Unit #: <?php echo e($user->unit_no); ?><br>
                                                    <?php endif; ?>
                                                    <?php if(isset($user->buzz_code)): ?>
                                                        Buzz Code:<?php echo e($user->buzz_code); ?><br>
                                                    <?php endif; ?>
                                                    <?php echo e($user->phone); ?>

                                                </address>
                                            </div>
                                            <?php 
                                                $date=date_create($order->booking_date);
                                                $new_date= date_format($date,"m/d/Y");
                                             ?>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4">
                                                <div class="sm-m-t-20">
                                                    <h2 class=" all-caps text-center font-weight-bold">
                                                        <?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format($order->pay_amount, 2)); ?>

                                                    </h2>
                                                    <address class="m-t-10 text-center">
                                                        <?php echo e($new_date); ?> <br>
                                                        
                                                        #<?php echo e($order->order_number); ?>

                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive table-invoice" id="responsive-table">
                                        <table class="table m-t-10">
                                            <thead>
                                            <tr>
                                                <th class="text-left">ITEM</th>
                                                <th class="text-center">QTY</th>
                                                <th class="text-right">AMOUNT</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            <?php
                                            $getOrderProducts = DB::select("select * from ordered_products where orderid='$order->id'");

                                            if(is_array($getOrderProducts) && count($getOrderProducts) > 0){
                                            foreach ($getOrderProducts as $orderDetails) {
                                            if($orderDetails != null){
                                            $productDetail = DB::select("select * from products where id='$orderDetails->productid'");
                                            ?>
                                            <tr>
                                                <td class="v-align-middle text-left"><?php echo e($productDetail[0]->title); ?>

                                                    <br/><?php echo e($order->service); ?> Service</td>

                                                <td class="v-align-middle text-center"><?php echo e($orderDetails->quantity); ?></td>
                                                <td class="v-align-middle text-right">
                                                    <?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format((float)$order->subtotal, 2, '.', '')); ?>

                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            }
                                            }
                                            ?>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <div class="col-sm-6 text-center"
                                                             style="padding: 1px!important; border-bottom: none;">
                                                            <div class="b-a b-grey p-10 paym-info" style="padding: 10px !important;">
                                                                <h5 class="m-b-30 font-weight-bold">PAYMENT
                                                                    INFORMATION
                                                                </h5>

                                                                <div class="m-t-10 text-right justify-content-center">
                                                                    <div class="row">
                                                                        <div class="col-6 text-right p-l-5 p-r-5">
                                                                            <strong>METHOD:</strong>
                                                                        </div>
                                                                        <div class="col-6 text-left p-l-5 p-r-5"><?php echo e($order->method); ?>

                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6 text-right p-l-5 p-r-5">
                                                                            <strong>REFERENCE:</strong></div>
                                                                        <div class="col-6 text-left p-l-5 p-r-5">
                                                                            <?php echo e($order->order_number); ?>

                                                                            <?php if($order->method != "Cash On Delivery"): ?>
                                                                                <?php if($order->method=="Stripe"): ?>
                                                                                    <p><?php echo e($order->order_number); ?></p>
                                                                                <?php endif; ?>
                                                                                <p><?php echo e($order->txnid); ?></p>
                                                                            <?php endif; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-6 text-center" colspan="2"
                                                             style="padding-bottom: 1px!important; border-bottom: none;">

                                                            <div class="row text-right ">
                                                                <div class="col-8 text-right"><strong>SUBTOTAL:</strong>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format((float)$order->subtotal, 2, '.', '')); ?>

                                                                </div>
                                                            </div>
                                                            <?php if((float)$order->discount_amount > 0): ?>
                                                                <div class="row text-right">
                                                                    <div class="col-8 text-right">
                                                                        <strong>DISCOUNT:</strong>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        -<?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format((float)$order->discount_amount, 2, '.', '')); ?>

                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="row text-right">
                                                                <div class="col-8 text-right"><strong>DELIVERY:</strong>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format((float)$order->delivery, 2, '.', '')); ?>

                                                                </div>
                                                            </div>
                                                            <div class="row text-right">
                                                                <div class="col-8 text-right"><strong>TAXES:</strong>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format((float)$order->tax, 2, '.', '')); ?>

                                                                </div>
                                                            </div>
                                                            <div class="row text-right">
                                                                <div class="col-8 text-right"><strong>MAKE IT
                                                                        COUNT:</strong>
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format((float)$order->make_it_count, 2, '.', '')); ?>

                                                                </div>
                                                            </div>

                                                            <div
                                                                    class="text-right bg-master-darker col-sm-height padding-10 d-flex flex-column justify-content-center align-items-end m-t-20">
                                                                <h5
                                                                        class="all-caps small no-margin hint-text text-white bold">
                                                                    Total</h5>
                                                                <h1 class="no-margin text-white">
                                                                    <?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format($order->pay_amount, 2)); ?>

                                                                </h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                    </div>
                                    </td>
                                    </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-default">
                            <div class="card-header separator">
                                <div class="card-title">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4">
                                            <a class="btn btn-primary btn-cons m-b-10 btn-block"
                                               onclick="printPage( '<?php echo e(route('home.order.print', ['id' => $order->id])); ?>' )"
                                               href="javascript:void(0);"></i> <span class="bold">PRINT</span></a>
                                        </div>
                                        <div class="col-md-4">
                                            <button id="download-btn"
                                                    class="btn btn-success btn-cons m-b-10 btn-block p-l-10"
                                                    type="button"><i class="fa fa-download"></i> <span class="bold">DOWNLOAD</span>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-success btn-cons m-b-10 btn-block" type="button"
                                                    hidden><i class="fa fa-envelope"></i> <span
                                                        class="bold">EMAIL</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
    <!-- END card -->


    <!-- END PAGE CONTENT -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        incrementVar = 1;

        function incrementValue(elem) {
            var $this = $(elem);
            $input = $this.prev('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val()) + 1;
            $parent.find('.inc').addClass('a' + newValue);
            $input.val(newValue);
            incrementVar += newValue;
        }

        function decrementValue(elem) {
            var $this = $(elem);
            $input = $this.next('input');
            $parent = $input.closest('div');
            newValue = parseInt($input.val()) - 1;
            $parent.find('.inc').addClass('a' + newValue);
            if (newValue <= 1) {
                $input.val(1);
            } else {
                $input.val(newValue);
            }
            incrementVar += newValue;
        }

        function printPage(url) {
            if (url) {
                var w = window.open(url, 'print page', 'height=900,width=800');
                if (window.focus) {
                    w.focus()
                }
                w.window.print();
                setTimeout(function () {
                    w.window.close();
                }, 2000);
                return false;
            }
        }
    </script>
    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(51.508742, -0.120850),
                zoom: 5,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
    </script>
    <script>
        $("#download-btn").click(function (e) {
            e.preventDefault();  //stop the browser from following
            window.location.href = '/shop_order_pdf/download/<?php echo $order->id;?>';
        });
    </script>
    <!-- END PAGE LEVEL JS -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.shop.user.new_main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>