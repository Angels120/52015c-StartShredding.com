<?php $__env->startSection('header'); ?>
<?php echo $__env->make('home.shop.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .jumbotron {
    background-color:#fff !important;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">


    <section class="p-b-65 p-t-50 m-t-30">
        <div class="container">
            <div class="row">
    <!-- Starting of login area -->
      <div class="jumbotron text-center">
        <h1 class="display-3">Thank you for signing up!</h1>
        <hr>
        
        <p class="lead">
          <a class="btn btn-primary btn-sm" href="<?php echo e(url('/')); ?>" role="button">Continue to homepage</a>
        </p>
        <br>
        <div>
        <p class="lead">
        <a class="btn btn-primary btn-sm" href="<?php echo e(url('/shop-signin')); ?>" role="button">Login</a>
        </p>
       </div>
      </div>
    <!-- Ending of login area -->
      </div>
      </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('home.shop.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.shop.includes.master',['cart_result'=> $response], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>