<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="keywords" content="<?php echo e($code[0]->meta_keys); ?>">
    <meta name="author" content="GeniusOcean">
    <link rel="icon" type="image/png" href="<?php echo e(url('/')); ?>/assets/images/<?php echo e($settings[0]->favicon); ?>" />
    <title><?php echo e($settings[0]->title); ?></title>

    <link href="<?php echo e(URL::asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/owl.carousel.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/bootstrap-slider.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/genius-slider.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/go-style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/css/responsive.css')); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->


</head>
<body>

<div id="content-block">
    <div class="content-center fixed-header-margin" style="padding-top: 114px;">
        <!-- HEADER -->
        <div class="header-wrapper style-10">
            <header class="type-1">

                <div class="header-product">
                    <div class="logo-wrapper">
                        <a href="<?php echo e(url('/')); ?>" id="logo">
                            <img alt="" src="<?php echo e(URL::asset('assets/images/logo')); ?>/<?php echo e($settings[0]->logo); ?>">
                        </a>
                    </div>

                    <div class="product-header-content">
                        <div class="line-entry">
                            <div class="menu-button responsive-menu-toggle-class"><i class="fa fa-reorder"></i></div>

                        </div>
                        
                        <div class="line-entry">
                            <div class="header-top-entry increase-icon-responsive open-search-popup">
                                <div class="title"><i class="fa fa-search"></i> <span><?php echo e($language->search); ?></span></div>
                            </div>
                            <div class="header-top-entry increase-icon-responsive login">
                                <a href="<?php echo e(url('/signin/vendor')); ?>" class="title"><i class="fa fa-group"></i> <span><?php echo e($language->vendor); ?></span></a>
                            </div>
                            <div class="header-top-entry increase-icon-responsive login">
                                <a href="<?php echo e(url('/signin/plant')); ?>" class="title"><i class="fa fa-group"></i> <span><?php echo e($language->plant); ?></span></a>
                            </div>
                            <div class="header-top-entry increase-icon-responsive login">
                                <?php if(Auth::guard('profile')->guest()): ?>
                                    <a href="<?php echo e(url('signin/user')); ?>" class="title"><i class="fa fa-user"></i> <span><?php echo e($language->sign_in); ?></span></a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('user.account')); ?>" class="title"><i class="fa fa-user"></i> <span><?php echo e($language->my_account); ?></span></a>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo e(url('/cart')); ?>" class="header-top-entry open-cart-popup" id="notify"><div class="title"><i class="fa fa-shopping-cart"></i><span><?php echo e($language->my_cart); ?></span> <b id="carttotal"><?php echo e($settings[0]->currency_sign); ?>0.00</b></div></a>

                        </div>
                    </div>
                </div>

                <div class="close-header-layer"></div>
                <div class="navigation">
                    <div class="navigation-header responsive-menu-toggle-class">
                        <div class="title">Navigation</div>
                        <div class="close-menu"></div>
                    </div>
                    <div class="nav-overflow">
                        <nav>
                            <ul>
                                <li class="simple-list"><a href="<?php echo e(url('/')); ?>" class=""><?php echo e($language->home); ?></a></li>

                                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="full-width-columns">
                                        <a href="<?php echo e(url('/category')); ?>/<?php echo e($menu->slug); ?>"><?php echo e($menu->name); ?></a>
                                        <?php if(\App\Category::where('mainid',$menu->id)->where('role','sub')->count() >0): ?>
                                            <i class="fa fa-chevron-down"></i>
                                            <div class="submenu">
                                                <?php $__currentLoopData = \App\Category::where('mainid',$menu->id)->where('role','sub')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="product-column-entry">
                                                        <div class="submenu-list-title"><a href="<?php echo e(url('/category')); ?>/<?php echo e($submenu->slug); ?>"><?php echo e($submenu->name); ?></a><span class="toggle-list-button"></span></div>
                                                        <div class="description toggle-list-container">
                                                            <ul class="list-type-1">
                                                                <?php $__currentLoopData = \App\Category::where('subid',$submenu->id)->where('role','child')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childmenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><a href="<?php echo e(url('/category')); ?>/<?php echo e($childmenu->slug); ?>"><i class="fa fa-angle-right"></i><?php echo e($childmenu->name); ?></a></li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </div>
                                                        <div class="hot-mark yellow">sale</div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($pagesettings[0]->a_status == 1): ?>
                                    <li class="simple-list"><a href="<?php echo e(url('/about')); ?>" class=""><?php echo e($language->about_us); ?></a></li>
                                <?php endif; ?>
                                <?php if($pagesettings[0]->f_status == 1): ?>
                                    <li class="simple-list"><a href="<?php echo e(url('/faq')); ?>" class=""><?php echo e($language->faq); ?></a></li>
                                <?php endif; ?>
                                <?php if($pagesettings[0]->blogs_status == 1): ?>
                                    <li class="simple-list"><a href="<?php echo e(url('/blogs')); ?>" class=""><?php echo e($language->blog); ?></a></li>
                                <?php endif; ?>
                                <?php if($pagesettings[0]->c_status == 1): ?>
                                    <li class="simple-list"><a href="<?php echo e(url('/contact')); ?>" class=""><?php echo e($language->contact_us); ?></a></li>
                                <?php endif; ?>

                                <li class="fixed-header-visible">
                                    <a class="fixed-header-square-button open-cart-popup"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="fixed-header-square-button open-search-popup"><i class="fa fa-search"></i></a>
                                </li>
                            </ul>

                            <div class="clear"></div>

                        </nav>
                        <div class="navigation-footer responsive-menu-toggle-class">

                        </div>
                    </div>
                </div>
            </header>
            <div class="clear"></div>
        </div>
    </div>

    <?php echo $__env->yieldContent('content'); ?>

        <!-- starting of footer area -->
        <footer class="section-padding footer-area-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="single-footer-area">
                            <div class="footer-title">
                                <?php echo e($language->about_us); ?>

                            </div>
                            <div class="footer-content">
                                <p>
                                    <?php echo e($settings[0]->about); ?>

                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="single-footer-area">
                            <div class="footer-title">
                                <?php echo e($language->footer_links); ?>

                            </div>
                            <div class="footer-content">
                                <ul class="about-footer">
                                    <li><a href="<?php echo e(url('/')); ?>"><i class="fa fa-caret-right"></i> <?php echo e($language->home); ?></a></li>
                                    <li><a href="<?php echo e(url('/about')); ?>"><i class="fa fa-caret-right"></i> <?php echo e($language->about_us); ?></a></li>
                                    <li><a href="<?php echo e(url('/faq')); ?>"><i class="fa fa-caret-right"></i> <?php echo e($language->faq); ?></a></li>
                                    <li><a href="<?php echo e(url('/contact')); ?>"><i class="fa fa-caret-right"></i> <?php echo e($language->contact_us); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="single-footer-area">
                            <div class="footer-title">
                                <?php echo e($language->latest_blogs); ?>

                            </div>
                            <div class="footer-content">
                                <ul class="latest-tweet">
                                    <?php $__currentLoopData = $lblogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lblog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(url('/blog')); ?>/<?php echo e($lblog->id); ?>">
                                            <img src="<?php echo e(url('/assets/images/blog')); ?>/<?php echo e($lblog->featured_image); ?>" alt="">
                                            <span><?php echo e($lblog->title); ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-6 col-xs-12">
                        <div class="single-footer-area">
                            <div class="footer-title">
                                <?php echo e($language->popular_tags); ?>

                            </div>
                            <div class="footer-content tags">
                                <?php $__currentLoopData = explode(',',$settings[0]->popular_tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(url('/tags')); ?>/<?php echo e($tag); ?>"><?php echo e($tag); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="col-md-6 col-sm-6 footer-copy">
                    <?php echo $settings[0]->footer; ?>

                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="footer-social-links">
                        <ul>
                            <?php if($sociallinks[0]->f_status == "enable"): ?>
                            <li>
                                <a class="facebook" href="<?php echo e($sociallinks[0]->facebook); ?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($sociallinks[0]->g_status == "enable"): ?>
                            <li>
                                <a class="google" href="">
                                    <i class="fa fa-google"></i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($sociallinks[0]->t_status == "enable"): ?>
                            <li>
                                <a class="twitter" href="<?php echo e($sociallinks[0]->twiter); ?>">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($sociallinks[0]->link_status == "enable"): ?>
                            <li>
                                <a class="tumblr" href="<?php echo e($sociallinks[0]->linkedin); ?>">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Ending of footer area -->


        <div class="cart-box popup">
            <div class="popup-container">
                <div id="emptycart">
                    <?php echo e($language->empty_cart); ?>

                </div>
                <div id="goCart">

                </div>
                <div class="summary">
                    <div class="grandtotal"><?php echo e($language->total); ?> <span id="grandttl"><?php echo e($settings[0]->currency_sign); ?>0.00</span></div>
                </div>
                <div class="cart-buttons">
                    <div class="column">
                        <a href="<?php echo e(url('/cart')); ?>" class="button style-3"><?php echo e($language->view_cart); ?></a>
                        <div class="clear"></div>
                    </div>
                    <div class="column">
                        <a href="<?php echo e(route('user.checkout')); ?>" class="button style-4"><?php echo e($language->checkout); ?></a>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>


        <div class="search-box popup">
            <form id="searchform">
                <button type="button" id="searchbtn" class="search-button">
                    <i class="fa fa-search"></i>

                </button>

                <div class="search-field">
                    <input type="text" id="searchdata" value="" placeholder="<?php echo e($language->search); ?>" />
                </div>
            </form>
        </div>

        <!-- Product Quick View Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="viewProduct">

                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

</div>

<script>
    var mainurl = '<?php echo e(url('/')); ?>';
    var currency = '<?php echo e($settings[0]->currency_sign); ?>';
    var language = <?php echo json_encode($language); ?>;
</script>

<script src="<?php echo e(URL::asset('assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/jquery.zoom.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/bootstrap-slider.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/wow.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/genius-slider.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/global.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/main.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/plugins.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/notify.js')); ?>"></script>
<?php echo $__env->yieldContent('footer'); ?>
</body>
</html>