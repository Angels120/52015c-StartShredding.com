<?php $__env->startSection('content'); ?>

    <!-- Blog Post area -->
    <div class="section-padding blog-post-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2><?php echo e($blog->title); ?></h2>
                        <ul class="blog-info">
                            <li><i class="fa fa-clock-o"></i> <?php echo e($blog->created_at->diffForHumans()); ?></li>
                            <?php if($blog->source != null): ?>
                                <li>Source: <?php echo e($blog->source); ?></li>
                            <?php endif; ?>
                            <li><i class="fa fa-eye"></i> <?php echo e($blog->views); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <p><img src="<?php echo e(url('assets/images/blog')); ?>/<?php echo e($blog->featured_image); ?>" alt=""></p>

                            <div class="entry-content">
                                <?php echo $blog->details; ?>

                            </div>
                            <div class="social-sharing">
                                <p><?php echo e($language->share_in_social); ?>:</p>
                                <!-- AddToAny BEGIN -->
                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                    <a class="a2a_button_facebook"></a>
                                    <a class="a2a_button_twitter"></a>
                                    <a class="a2a_button_pinterest"></a>
                                    <a class="a2a_dd" href="https://www.geniusocean.com"></a>
                                </div>
                                <script async src="https://static.addtoany.com/menu/page.js"></script>
                                <!-- AddToAny END -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="post-sidebar-area">
                                <h2 class="post-heading"><?php echo e($language->latest_blogs); ?></h2>
                                <ul>
                                    <?php $__currentLoopData = $recents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><i class="fa fa-angle-right"></i> <a href=""><?php echo e($recent->title); ?></a> <span><?php echo e($recent->created_at->diffForHumans()); ?></span></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.newmaster', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>