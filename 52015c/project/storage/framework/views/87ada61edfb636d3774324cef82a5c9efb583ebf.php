<?php $__env->startSection('content'); ?>
<style>
    .jumbotron {
    background-color:#fff !important;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">


<div class="home-wrapper">
    <!-- Starting of login area -->
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank you for signing up!</h1>
        <p class="lead"><strong>Please check your inbox for the account activation link.</strong></p>
        <hr>
        
        <p class="lead">
          <a class="btn btn-primary btn-sm" href="<?php echo e(url('/')); ?>" role="button">Continue to homepage</a>
        </p>
      </div>
    <!-- Ending of login area -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.newmaster2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>