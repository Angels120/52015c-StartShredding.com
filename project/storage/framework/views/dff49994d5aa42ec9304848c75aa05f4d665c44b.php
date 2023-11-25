<?php $__env->startSection('content'); ?>

<div class="home-wrapper">
    <!-- Starting of login area -->
    <div class="section-padding login-area-wrapper wow fadeInUp">
        <div class="container">



            <div class="row">
                <div class="col-sm-3 col-xs-12 hidden-xs col-sm-offset-2">
                    <div>
                        <img class="login-logo" src="<?php echo e(url('/assets/img/ube_logo_ig.png')); ?>">
                    </div>
                </div>

                <div class="col-sm-5  col-xs-12">
                    <div class="signIn-area">
                        <h2 class="signIn-title">
                            
                            Sign in
                            
                        </h2>
                        <hr />
                        <?php if($type == 'vendor'): ?>
                        <form action="<?php echo e(route('vendor.login.submit')); ?>" method="POST">
                            <?php elseif($type == 'plant'): ?>
                            <form action="<?php echo e(route('plant.login.submit')); ?>" method="POST">
                                <?php else: ?>
                                <form action="<?php echo e(route('user.login.submit')); ?>" method="POST">
                                    <?php endif; ?>

                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group">
                                        <label for="email">Email Address <span>*</span></label>
                                        <input class="form-control" value="<?php echo e(old('email')); ?>" type="email" name="email"
                                            id="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <span>*</span></label>
                                        <input class="form-control" type="password" name="password" id="password"
                                            required>
                                        <span toggle="#password"
                                            class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <?php if($type == 'user'): ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <a href="<?php echo e(route('user.reg')); ?>">Create New Account</a>
                                            </div>
                                            <?php else: ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <a href="<?php echo e(route('vendor.reg')); ?>">Create New Account</a>
                                            </div>
                                            <?php endif; ?>

                                            <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                                <a href="<?php echo e(route('user.forgotpass')); ?>">Forgot your Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="resp">
                                        <?php if($errors->has('password')): ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($errors->has('email')): ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($message = Session::get('success')): ?>
                                        <div class="alert alert-success alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                            <strong><?php echo e($message); ?></strong>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($message = Session::get('warning')): ?>
                                        <div class="alert alert-warning alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                            <strong><?php echo e($message); ?></strong>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-md login-btn" type="submit" value="LOGIN">
                                    </div>
                                </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Ending of login area -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script>
    $(".toggle-password").click(function() {

var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
  $(this).toggleClass("far fa-eye-slash");
} else {
  input.attr("type", "password");
  $(this).toggleClass("far fa-eye");
}
});
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('.login-btn').attr('disabled', 'disabled');
            });
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.newmaster2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>