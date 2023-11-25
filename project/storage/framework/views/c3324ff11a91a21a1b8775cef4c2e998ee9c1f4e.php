<!DOCTYPE html>
<html>
<head>
    <?php echo $__env->make('home.shop.user._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="fixed-header">
<?php echo $__env->make('home.shop.user._nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="page-content-wrapper ">
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('home.shop.user._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
</div>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>