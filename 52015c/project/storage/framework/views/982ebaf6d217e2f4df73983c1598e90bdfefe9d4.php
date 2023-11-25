<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('home.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .logo {
            margin-top: 10px;
        }
        .login-btn:hover
        {
            color: #0059B2;
        }
        .field-icon
        {
            float: right;
            position: relative;
            z-index: 2;
            top: -24px;
            left: -7px;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <section class="p-b-65 p-t-50 m-t-30">
    <div class="container">
        <div class="row">
                <div class="col-sm-2 col-xs-12 hidden-xs col-sm-offset-2">
                    <div>

                    </div>
                </div>

                <div class="col-sm-4  col-xs-12">
                    <div class="row">
                                <?php if($login_message = Session::get('login_message')): ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><?php echo e($login_message); ?></strong>
                                    </div>
                                <?php endif; ?>
                    </div>
                    <div class="signIn-area">
                        <h2 class="signIn-title">Sign in</h2>
                        <hr />
                        <form action="<?php echo e(route('home.login.submit')); ?>" method="POST">

                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="email">Email Address <span>*</span></label>
                                <input class="form-control" value="<?php echo e(old('email')); ?>" type="email" name="email"
                                       id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span>*</span></label>
                                <input class="form-control" type="password" name="password" id="password" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a href="<?php echo e(route('home.register.submit')); ?>">Create New Account</a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                        <a href="<?php echo e(route('home.forgotpass')); ?>">Forgot your Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div id="resp">
                                <?php if($errors->has('password')): ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </div>
                                <?php endif; ?>
                                <?php if($errors->has('email')): ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </div>
                                <?php endif; ?>
                                <?php if($message = Session::get('success')): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                                <?php endif; ?>
                                <?php if($message = Session::get('warning')): ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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
            <br><br><br><br><br><br><br><br><br><br><br><br><br>

            </div>
        </div>

</section>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('home.shop.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.includes.master',['cart_result'=> $response], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>