<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('home.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .btn-primary, .btn-primary:focus {
            background-color: #000080;
            border-color: #000080;
        }
        .jumbotron {
            background-color: #fff !important;
        }
    </style>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <br>
    <section class="p-b-65 p-t-20 m-t-30">
        <div class="container">
            <div class="row">
                <!-- Starting of login area -->
                <div class="jumbotron text-center" style="margin-top: 6%">
                    <h1 class="display-3">Oops!!</h1>
                    <p class="lead"><strong>Your password reset link is expired..</strong></p>
                    <hr>
                    <p class="lead">
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('home.user')); ?>" role="button">Back to Sign
                            In</a>
                    </p>
                </div>
                <br>
                <br>
                <br>
                <!-- Ending of login area -->
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('home.shop.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.includes.master',['cart_result'=> $response], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>