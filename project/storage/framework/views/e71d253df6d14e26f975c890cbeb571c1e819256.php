<?php $__env->startSection('content'); ?>

<div class="home-wrapper">
    <!-- Starting of Account Dashboard area -->
    <div class="section-padding dashboard-account-wrapper wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('includes.usermenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-9">
                    <div class="dashboard-content">
                        <div id="account-information-tab">
                            <h1>edit account information</h1>
                            <div class="edit-account-info-div">
                                <h3>account information</h3>
                                <?php if(Session::has('message')): ?>
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php echo e(Session::get('message')); ?>

                                    </div>
                                <?php endif; ?>
                                <p><span>*</span> required field</p>
                                <form action="<?php echo e(action('ClientsController@update',['id' => $user->id])); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_fname">Full name <span>*</span></label>
                                            <input class="form-control" type="text" name="name" id="dash_fname" value="<?php echo e($user->name); ?>" placeholder="first name" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">email address <span>*</span></label>
                                            <input class="form-control" type="email" name="mail" value="<?php echo e($user->email); ?>" id="dash_email" placeholder="email address" disabled required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">Phone Number <span>*</span></label>
                                            <input class="form-control" type="text" name="phone" value="<?php echo e($user->phone); ?>" placeholder="Phone Number" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">Address <span>*</span></label>
                                            <textarea name="address" placeholder="Address" class="form-control" required><?php echo e($user->address); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">City <span>*</span></label>
                                            <input name="city" placeholder="City" value="<?php echo e($user->city); ?>" class="form-control"  type="text" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="dash_email">Postal Code <span>*</span></label>
                                            <input name="zip" placeholder="Postal Code" class="form-control" value="<?php echo e($user->zip); ?>" type="text" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <a class="btn btn-md back-btn" href="<?php echo e(route('user.account')); ?>">back</a>
                                            <input class="btn btn-md save-btn" type="submit" value="save">
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
    <!-- Ending of Account Dashboard area -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.newmaster', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>