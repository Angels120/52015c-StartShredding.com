<?php $__env->startSection('header'); ?>
<?php echo $__env->make('home.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="https://code.jquery.com/jquery-1.12.1.min.js" name="jquery"></script>
<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDiNJfWJG8MhalcsGzfQrwhx5UWdVLhZvw&libraries=places'></script>

<script type="text/javascript">
    $(document).ready(function() {
        var placeSearch, autocomplete;
        $("#autocomplete").on("keyup", function(e) {
            e.preventDefault();
            var code = e.keyCode || e.which;
            if (code == 40) {
                if ($('.serachwrap .focus').length == 0)
                    $('.serachwrap li:first-child').addClass('focus');
                else {
                    var el = $('.serachwrap li.focus');
                    $('.serachwrap li').removeClass('focus');
                    el.next('li').addClass('focus');
                }
                return;
            } else if (code == 38) {
                if ($('.serachwrap .focus').length == 0)
                    $('.serachwrap li:last-child').addClass('focus');
                else {
                    var el = $('.serachwrap li.focus');
                    $('.serachwrap li').removeClass('focus');
                    el.prev('li').addClass('focus');
                }
                return;
            } else if (code == 13) {
                e.preventDefault();
                var el = $('.serachwrap li.focus');
                if (el.length) {
                    var string = $('.serachwrap li.focus').attr('title');
                    $('#autocomplete').val(string);
                    var geocd = new google.maps.Geocoder();
                    geocd.geocode({
                        "address": string
                    }, fillInAddress);
                    $('#result').hide();
                    return false;
                }
            }
            $('#result').hide();
            $('#result').html('');
            var inputData = $("#autocomplete").val();
            service = new google.maps.places.AutocompleteService();

            var request1 = {
                input: inputData,
                types: ['geocode'],
                componentRestrictions: {
                    country: 'us'
                },
            };
            var request2 = {
                input: inputData,
                types: ['geocode'],
                componentRestrictions: {
                    country: 'ca'
                },
            };
            $('#result').empty();
            service.getPlacePredictions(request1, callback);
            service.getPlacePredictions(request2, callback);

        });

        function callback(predictions, status) {

            $('#result').html('');
            $('#result').hide();
            var resultData = '';
            if (predictions != '') {
                for (var i = 0; i < predictions.length; i++) {
                    resultData += '<li title="' + predictions[i].description + '"><a href="request_quote/?s=' + predictions[i].description + '"><i class="fa fa-map-marker"></i>' + predictions[i].description + '</a></li>';
                }
                if ($('#result').html() != undefined && $('#result').html() != '') {
                    resultData = $('#result').html() + resultData;
                }
                if (resultData != undefined && resultData != '') {
                    $('#result').html(resultData).show();
                    $('#result').show();
                }
            }

        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- BEGIN JUMBOTRON -->
<section class="jumbotron full-vh" data-pages="parallax">
    <div class="inner full-height">
        <!-- BEGIN SLIDER -->
        <div class="swiper-container" id="hero">
            <div class="swiper-wrapper">
                <!-- BEGIN SLIDE -->
                <div class="swiper-slide fit bg-complete">
                    <!-- BEGIN IMAGE PARRALAX -->
                    <div class="slider-wrapper">
                        <div class="background-wrapper" data-swiper-parallax="20%">
                            <!-- YOUR BACKGROUND IMAGE HERE, YOU CAN ALSO USE IMG with the same classes -->
                            <div data-pages-bg-image="<?php echo e(url('home_assets/images/bkg-home.jpg')); ?>" draggable="false" class="background" data-bg-overlay="black" data-overlay-opacity="0.4"></div>
                        </div>
                    </div>
                    <!-- END IMAGE PARRALAX -->
                    <!-- BEGIN CONTENT -->
                    <div class="content-layer">
                        <div class="inner full-height">
                            <div class="container-xs-height full-height">
                                <div class="col-xs-height col-middle text-left">
                                    <div class="container text-center">
                                        <!-- <h1 class="m-t-5 light text-white" data-pages-animation="standard" data-delay="600"
                        data-type="transition.slideDownIn">
                        Over <span class="font-montserrat">100's</span> of pre-designed UI Blocks
                      </h1>
                      <h5 class="block-title text-white" data-pages-animation="standard" data-delay="1000"
                        data-type="transition.fadeIn">For the Price of One</h5> -->
                                        <div class="row">
                                            <div class="col-md-12 m-t-50">
                                                <h1 class="m-t-5 light text-white" data-pages-animation="standard" data-delay="600" data-type="transition.slideDownIn">
                                                    <span class="font-montserrat">Ready to Shred</span>
                                                </h1>
                                                <h2 class="light text-white" data-pages-animation="standard" data-delay="600" data-type="transition.slideDownIn">
                                                    <span class="font-georgia">Los Angeles Shredding Service</span>
                                                </h2> <br>
                                                <p class="small text-white" data-pages-animation="standard" data-delay="600" data-type="transition.slideDownIn">We provide GUARANTEED lowest pricing for Secure Paper
                                                    Shredding
                                                    Services<br>
                                                    Request A Quote and get started on shredding personal & confidential documents</p>
                                            </div>
                                            <div class="col-md-12 m-t-30" data-pages-animation="standard" data-delay="600" data-type="transition.slideDownIn">
                                                <form method="get" action="request_quote/">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="location-field" align="center">
                                                                <input class="form-control" type="text" id="autocomplete" placeholder="Enter your EXACT address" autocomplete="off" />
                                                                <ul id="result" class="serachwrap"></ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 m-t-20">
                                                            <button type="submit" class="btn btn-default green_btn text-white btn-lg" /><b>Let's Get
                                                                Started</b></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-12 m-t-50" style="z-index: -1;">
                                                <img src="<?php echo e(url('home_assets/images/coca-cola.png')); ?>" width="116"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="<?php echo e(url('home_assets/images/google.png')); ?>" width="115"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="<?php echo e(url('home_assets/images/apple.png')); ?>" width="42"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="<?php echo e(url('home_assets/images/canon.png')); ?>" width="124"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="<?php echo e(url('home_assets/images/nike.png')); ?>" width="83"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="<?php echo e(url('home_assets/images/audi.png')); ?>" width="85">
                                            </div>
                                            <div class="col-md-12">
                                                <p class="text-white m-t-20">Take a peek at some of our <b>satisfied</b> customers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT -->
                </div>
                <!-- END SLIDE -->
            </div>
            <!-- BEGIN ANIMATED MOUSE -->
            <div class="mouse-wrapper">
                <div class="mouse">
                    <div class="mouse-scroll"></div>
                </div>
            </div>
            <!-- Add Navigation -->
            <div class="swiper-navigation swiper-rounded swiper-white-solid swiper-button-prev"></div>
            <div class="swiper-navigation swiper-rounded swiper-white-solid swiper-button-next"></div>
        </div>
    </div>
    <!-- END SLIDER -->
</section>

<!-- BEGIN INTRO CONTENT -->
<section class="p-b-100 p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 text-center hover-push demo-story-block">
                <div class="hover-backdrop" style="background:url('home_assets/images/offsiteshredding.jpg');"></div>
                <div class="hover-caption bottom-left bottom-right p-b-40">
                    <h4 class="text-white m-b-25">Paint it the way you like it!</h4>
                    <a class="font-montserrat fs-12 hint-text text-white all-caps">More information</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 text-center bg-success hover-push demo-story-block">
                <div class="hover-backdrop" style="background:url('home_assets/images/mobileshredding.jpg');"></div>
                <div class="hover-caption bottom-left bottom-right p-b-40">
                    <h4 class="text-white m-b-25">Capture the moments</h4>
                    <a class="font-montserrat fs-12 hint-text text-white all-caps">More information</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 text-center bg-success hover-push demo-story-block">
                <div class="hover-backdrop" style="background:url('home_assets/images/dropoffshredding.jpg');"></div>
                <div class="hover-caption bottom-left bottom-right p-b-40">
                    <h4 class="text-white m-b-25">Digital solutions led by<br>
                        clarity, simplicity & honesty</h4>
                    <a class="font-montserrat fs-12 hint-text text-white all-caps">More information</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END INTRO CONTENT -->

<section class="p-b-65 p-t-60 bg-master-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-6 col-md-4">
                <h1 class="text-white"><b>PROVEN</b></h1>
                <p class="text-white fs-14">15 YEARS
                    <br>10,000 + CUSTOMERS
                    <br>2 MILLION + BOXES DESTROYED
                    <br>ZERO DATA BREACH
                </p>
            </div>
            <div class="col-12 col-xs-12 col-sm-6 col-md-8">
                <h2 class="text-white"><b>About Us</b></h2>
                <p class="text-white fs-13">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
                    electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of
                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
                    Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
        </div>
    </div>
</section>

<!-- Off Site Shredding -->
<section class="p-b-40 p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="m-t-5 light">Off Site Shredding</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding" src="<?php echo e(url('home_assets/images/color-wheel.jpg')); ?>" alt="">
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <h6 class="block-title"><b>EIGHT BASE COLOR PALLETE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">The dashboard will synergize with the colour selection made by the user and appropriately
                    amend. Similarly, all other elements will sync according to the base colours.</p>
                <h6 class="block-title m-t-50"><b>CHROMA BASE COLORS</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">The monochrome base color is made by having a zero saturation percentage which will adapat
                    to any color placed near it.</p>
            </div>
        </div>
        <hr class="double">
    </div>

    <div class="container p-t-20">
        <div class="row">
            <div class="col-md-12">
                <h2 class="m-t-5 light">Mobile Shredding</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <h6 class="block-title"><b>EIGHT BASE COLOR PALLETE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">The dashboard will synergize with the colour selection made by the user and appropriately
                    amend. Similarly, all other elements will sync according to the base colours.</p>
                <h6 class="block-title m-t-50"><b>CHROMA BASE COLORS</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">The monochrome base color is made by having a zero saturation percentage which will adapat
                    to any color placed near it.</p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding" src="<?php echo e(url('home_assets/images/color-wheel.jpg')); ?>" alt="">
            </div>
        </div>
        <hr class="double">
    </div>

    <div class="container p-t-20">
        <div class="row">
            <div class="col-md-12">
                <h2 class="m-t-5 light">City Shredding Service</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.</p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding" src="<?php echo e(url('home_assets/images/color_wheel.png')); ?>" alt="">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="m-t-25 light">Our Service Areas</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.</p>
            </div>
        </div>
        <hr class="double">
    </div>
</section>
<!-- Off Site Shredding -->

<!-- BEGIN FOOTER -->
<section class="p-b-70">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-6 col-sm-6 col-6">
                <img alt="" src="<?php echo e(url('home_assets/images/logo_black.png')); ?>">
            </div>
            <div class="col-md-3 col-xs-6 col-sm-6 col-6">
                <ul class="no-style fs-12 no-padding xs-m-t-20">
                    <li class="inline no-padding"><a href="#" class="text-black fs-16 xs-no-padding"><i class="fa fa-facebook"></i></a></li>
                    <li class="inline no-padding"><a href="#" class="text-black p-l-30 fs-16 xs-no-padding"><i class="fa fa-twitter"></i></a></li>
                    <li class="inline no-padding"><a href="#" class="text-black p-l-30 fs-16 xs-no-padding"><i class="fa fa-dribbble"></i></a></li>
                    <li class="inline no-padding"><a href="#" class="text-black p-l-30 fs-16 xs-no-padding"><i class="fa fa-rss"></i></a></li>
                    <li class="inline no-padding"><a href="#" class="text-black p-l-30 fs-16 xs-no-padding"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="row m-t-30">
            <div class="col-md-2 col-sm-3 col-xs-6 col-12">
                <p class="fs-14">StartShredding Inc.</p>
                <p class="fs-14">327 Evans Avenue
                    <br> Toronto, Ontario
                    <br> Canada M8Z 1K2
                </p>
                <p class="fs-14">Phone: (416) 255 1500
                    <br> Toll Free: (866) 931 8615
                    <br> Fax: (866) 931 8615
                </p>
                <p class="fs-14"><a style="color: black;" href="#">Contact Us by Email</a>
                </p>
            </div>
            <div class="col-md-7 col-sm-6 col-xs-12 col-12">
                <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d184551.80857903487!2d-79.51814365082902!3d43.7184038124084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4cb90d7c63ba5%3A0x323555502ab4c477!2sToronto%2C%20ON%2C%20Canada!5e0!3m2!1sen!2slk!4v1587192248189!5m2!1sen!2slk" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 col-12">
                <p><a class="link text-black fs-16 sm-p-r-30" href="#"> Help Center
                    </a><br>
                    <a class="link text-black fs-16 sm-p-r-30" href="#">Pages License
                        Details</a><br>
                    <a class="link text-black fs-16 sm-p-r-30" href="#">Contact us</a>
                    <br>
                    <a class="link text-black fs-16 sm-p-r-30" href="#">Meet the
                        team</a>
                    <br>
                    <a class="link text-black fs-16 sm-p-r-30" href="#">Terms &
                        Conditions</a>
                </p>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('home.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.includes.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>