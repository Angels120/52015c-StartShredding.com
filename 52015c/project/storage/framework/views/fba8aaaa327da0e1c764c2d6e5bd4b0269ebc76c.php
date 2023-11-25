<!DOCTYPE html>
<html>
    <head>
    
        <?php echo $__env->make('partials._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    </head>
    <body class="fixed-header">
        <?php echo $__env->make('partials._nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- START PAGE CONTENT WRAPPER -->
        <div class="page-content-wrapper ">
        

            <?php echo $__env->yieldContent('content'); ?>

            <?php echo $__env->make('partials._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>

<!-- END PAGE CONTAINER -->
<?php echo $__env->yieldContent('scripts'); ?>
    </body>
</html>