<?php $__env->startSection('content'); ?>


    <section style="background: url(<?php echo e(url('/')); ?>/assets/images/<?php echo e($settings[0]->background); ?>) no-repeat center center; background-size: cover;">
        <div class="row" style="background-color:rgba(0,0,0,0.7);">

            <div style="margin: 3% 0px 3% 0px;">
                <div class="text-center" style="color: #FFF;padding: 20px;">
                    <h1><?php echo e($language->about_us); ?></h1>
                </div>
            </div>

        </div>


    </section>


    <div class="home-wrapper">
        <!-- Starting of contact us area -->
        <div class="section-padding contact-area-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <?php echo $pagedata->about; ?>

                </div>
            </div>
        </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.newmaster', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>