<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8" />
  <title>Shredding Service</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN PLUGINS -->
  <link href="<?php echo e(URL::asset('home_assets/plugins/pace/pace-theme-flash.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('home_assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('home_assets/plugins/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('home_assets/plugins/swiper/css/swiper.css')); ?>" rel="stylesheet" type="text/css" media="screen" />
  <!-- END PLUGINS -->
  <!-- BEGIN PAGES CSS -->
  <link class="main-stylesheet" href="<?php echo e(URL::asset('home_assets/css/pages.css')); ?>" rel="stylesheet" type="text/css" />
  <link class="main-stylesheet" href="<?php echo e(URL::asset('home_assets/css/pages-icons.css')); ?>" rel="stylesheet" type="text/css" />
  <!-- BEGIN PAGES CSS -->

  <!--Start of Zopim Live Chat Script-->
  <script type="text/javascript">
    window.$zopim || (function (d, s) {
      var z = $zopim = function (c) { z._.push(c) }, $ = z.s =
        d.createElement(s), e = d.getElementsByTagName(s)[0]; z.set = function (o) {
          z.set.
            _.push(o)
        }; z._ = []; z.set._ = []; $.async = !0; $.setAttribute("charset", "utf-8");
      $.src = "//v2.zopim.com/?3jmVcGcYpBIYiSqngBlagBJLsX7NK73t"; z.t = +new Date; $.
        type = "text/javascript"; e.parentNode.insertBefore($, e)
    })(document, "script");
  </script>
  <!--End of Zopim Live Chat Script-->
</head>

<body class="pace-dark">
    <?php echo $__env->yieldContent('header'); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldContent('footer'); ?>
  <!-- END FOOTER -->
  <!-- BEGIN CORE FRAMEWORK -->
  <script src="<?php echo e(URL::asset('home_assets/plugins/pace/pace.min.js')); ?>" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo e(URL::asset('home_assets/js/pages.image.loader.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(URL::asset('home_assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
  <!-- BEGIN SWIPER DEPENDENCIES -->
  <script type="text/javascript" src="<?php echo e(URL::asset('home_assets/plugins/swiper/js/swiper.jquery.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(URL::asset('home_assets/plugins/velocity/velocity.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(URL::asset('home_assets/plugins/velocity/velocity.ui.js')); ?>"></script>
  <!-- BEGIN RETINA IMAGE LOADER -->
  <script type="text/javascript" src="<?php echo e(URL::asset('home_assets/plugins/jquery-unveil/jquery.unveil.min.js')); ?>"></script>
  <!-- END VENDOR JS -->
  <!-- BEGIN PAGES FRONTEND LIB -->
  <script type="text/javascript" src="<?php echo e(URL::asset('home_assets/js/pages.frontend.js')); ?>"></script>
  <!-- END PAGES LIB -->
  <!-- BEGIN YOUR CUSTOM JS -->
  <script type="text/javascript" src="<?php echo e(URL::asset('home_assets/js/custom.js')); ?>"></script>
  <!-- END PAGES LIB -->
</body>

</html>