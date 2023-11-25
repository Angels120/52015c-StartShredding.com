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
                        <div id="account-dashboard-tab">
                            <h2>my dashboard</h2>
                            <div class="dashboard-breadcroumb-section">
                                <img src="<?php echo e(url('/')); ?>/assets/img/testimonial-bg-img.jpg" alt="">
                                <div class="customer-info">
                                    <h1><?php echo e($user->name); ?></h1>
                                    <p class="customer-id"><?php echo e($user->email); ?></p>
                                    <p class="customer-points"><?php echo e($user->phone); ?></p>
                                </div>
                            </div>
                            <div class="account-info-div">
                                <h3>acconut information</h3>
                                <div class="single-account-info-div">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                                <p class="colored-p">default billing address</p>
                                                <p><strong>Name: </strong><?php echo e($user->name); ?></p>
                                                <p><strong>Email: </strong><?php echo e($user->email); ?></p>
                                                <p><strong>Phone: </strong><?php echo e($user->phone); ?></p>
                                                <p><strong>Address: </strong><?php echo e($user->address); ?></p>
                                                <p><strong>City: </strong><?php echo e($user->city); ?></p>
                                                <p><strong>Post Code: </strong><?php echo e($user->zip); ?></p>
                                                <a href="<?php echo e(route('user.accinfo')); ?>" class="address-btn">Edit address</a>
                                        </div>
                                    </div>
                                </div>
                                
                                    
                                    
                                        
                                            
                                                
                                                
                                                
                                                
                                            
                                            
                                                
                                            
                                        
                                        
                                            
                                                
                                                
                                                
                                                
                                            
                                            
                                                
                                            
                                        
                                    
                                
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