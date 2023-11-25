<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

?>


<?php $__env->startSection('content'); ?>
<div class="page-title">
		<h2>Customer</h2>
</div>
<link href="<?php echo e(URL::asset('assets/map/css/bootstrap.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::asset('assets/map/css/custom.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::asset('assets/map/css/font-awesome.min.css')); ?>" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places"></script>

<script src="<?php echo e(URL::asset('assets/map/js/jquery1.11.3.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/map/js/bootstrap3.3.4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/map/js/jquery.blockUI.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $.blockUI.defaults = {

            message: '&lt;h1&gt;Please wait...&lt;/h1&gt;',

            title: null,

            draggable: true,

            theme: false,

            css: {
                padding: 0,
                margin: 0,
                width: '30%',
                top: '10%',
                left: '35%',
                textAlign: 'center',
                color: '#000',
                border: '3px solid #aaa',
                backgroundColor: '#fff'
                        //cursor: 'wait'
            },

            themedCSS: {
                width: '30%',
                top: '40%',
                left: '35%'
            },

            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.6
                        //cursor: 'wait'
            },

            cursorReset: 'default',

            growlCSS: {
                width: '350px',
                top: '10px',
                left: '',
                right: '10px',
                border: 'none',
                padding: '5px',
                opacity: 0.6,
                cursor: null,
                color: '#fff',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px'
            },

            iframeSrc: /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank',

            forceIframe: false,

            baseZ: 1000,

            centerX: true,

            centerY: true,

            allowBodyStretch: true,

            bindEvents: true,

            constrainTabKey: true,

            fadeIn: 200,

            fadeOut: 400,

            timeout: 0,

            showOverlay: true,

            focusInput: true,

            onBlock: null,

            onUnblock: null,

            quirksmodeOffsetHack: 4,

            blockMsgClass: 'blockMsg',

            ignoreIfBlocked: false
        };

        $(document).on('click', '.js-invoice_to_email', function (e) {
            e.preventDefault();
            e.stopPropagation();

            $.blockUI({
                message: $('#emails_form')
            });

            $('.blockOverlay').click($.unblockUI);
            //$('.close-box-button').click($.unblockUI);
        });


    });
</script>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <!--<h3 class="request-quote">Welcome! Please select one of the following:</h3>-->
            <div  class="col-xs-12">
                <div class="inner">
                    <div id="wizard-form" class="wizard">
                        <ul class="steps">
                            <li data-target="step1"><span class="badge badge-info">1</span>Customer<span class="chevron"></span></li>
                            <li data-target="step2"><span class="badge">2</span>Order<span class="chevron"></span></li>
                            <li data-target="step3" class="active"><span class="badge">3</span>Confirm<span class="chevron"></span></li>
                        </ul>
                    </div>
                    <form method="post" action="" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12">
                        <?php echo e(csrf_field()); ?>

                        <?php if(Session::get('error') != ""): ?>
                            <div class="bg-danger">
                                <div id="flashMessage" class="bg-danger"><?php echo e(Session::get('error')); ?></div>
                            </div>
                        <?php else: ?>
                            <?php if(empty($view)): ?>
                            <div class="bg-success">
                                <div id="flashMessage" class="bg-success">Order added successfully!</div>
                            </div>
                            <?php elseif($view == 2): ?>
                            <div class="bg-success">
                                <div id="flashMessage" class="bg-success">Invoice was sent to email</div>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                       
                        <div class="table">
                            <table style="width: 100%; margin: auto; font-family: Arial;">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="color: #668fbd; padding: 15px 0; font-weight: bold; font-size: 24px;">Order Details</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table style="width: 100%; border-collapse: collapse;">
                                                <thead>
                                                    <tr style="font-weight: bold; text-align: center;">
                                                        <td style="border: 1px solid #000; width: 20%; padding: 5px 0;">ITEM</td>
                                                        <td style="border: 1px solid #000; width: 35%; padding: 5px 0;">DESCRIPTION</td>
                                                        <td style="border: 1px solid #000; width: 15%; padding: 5px 0;">QTY</td>
                                                        <td style="border: 1px solid #000; width: 15%; padding: 5px 0;">RATE</td>
                                                        <td style="border: 1px solid #000; width: 15%; padding: 5px 0;">TOTAL</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $subtotal=0;
                                                    $orderid = $_GET['orderid'];
                                                    $getOrderProducts = DB::select("select * from ordered_products where orderid='$orderid'");
                                                   if(is_array($getOrderProducts) && count($getOrderProducts)>0){
                                                        foreach ($getOrderProducts as $orderDetails) { 
                                                            if($orderDetails!=null){
                                                            $productDetail = \App\Product::findOrFail($orderDetails->productid);
                                                            $subtotal =($orderDetails->cost * $orderDetails->quantity)+$subtotal;
                                                            ?>
                                                              <tr style="text-align: center;">
                                                              <td style="border: 1px solid #000; width: 20%; padding: 5px 0;"><?php echo e($productDetail->title); ?></td>
                                                              <td style="border: 1px solid #000; width: 35%; padding: 5px 0;"><?php echo e($productDetail->description); ?></td>
                                                              <td style="border: 1px solid #000; width: 15%; padding: 5px 0;"><?php echo e($settings[0]->currency_sign); ?><?php echo e($orderDetails->cost); ?></td>
                                                              <td style="border: 1px solid #000; width: 15%; padding: 5px 0;"><?php echo e($orderDetails->quantity); ?></td>
                                                              <td style="border: 1px solid #000; width: 15%; padding: 5px 0;"><?php echo e($settings[0]->currency_sign); ?><?php echo e($orderDetails->cost * $orderDetails->quantity); ?></td>
                                                            </tr>
                                                            <?php	
                                                          
                                                        }
                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="border: 1px solid #000; padding: 10px; text-align: right; background-color: #f3f6fb;">Subtotal:</td>
                                                        <td style="border: 1px solid #000; padding: 10px; text-align: right; background-color: #f3f6fb;"><?php echo e($settings[0]->currency_sign); ?><?php echo e($subtotal); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="border: 1px solid #000; padding: 10px; text-align: right; background-color: #f3f6fb;"></td>
                                                        <td style="border: 1px solid #000; padding: 10px; text-align: right; background-color: #f3f6fb;"></td>
                                                    </tr>
                                                    <tr style="font-weight: bold;">
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="border: 1px solid #000; padding: 10px; text-align: right; background-color: #f3f6fb;">Total:</td>
                                                        <td style="border: 1px solid #000; padding: 10px; text-align: right; background-color: #f3f6fb;"><?php echo e($settings[0]->currency_sign); ?><?php echo e($subtotal); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
               

<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>