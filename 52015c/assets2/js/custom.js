/*
	Author: Umair Chaudary @ Pixel Art Inc.
	Author URI: http://www.pixelartinc.com/
*/


$(document).ready(function(e) {
    // Slideshow
    $("#slishow_wrap12").owlCarousel({
        responsive:{
            0:{
                items:1
            }
        },
        navigation: true,
        dots: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        loop: true
    });
    // ----------AND----------------

    // pproducts_deals_ lefft
    $("#pproducts_deals").owlCarousel({
        responsive:{
            0:{
                items:1
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------

    // sns_blog_ left , testimoniol page2
    $(".slider-left9 ").owlCarousel({
        responsive:{
            0:{
                items:1
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------

    // sns_producttaps1
    $(".taps-slider1").owlCarousel({
        responsive:{
            0:{
                items:1
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        loop: true
    });
    // ----------AND----------------

    // sns_slider1_page2
    $(".sns-slider-page1").owlCarousel({
        responsive:{
            0:{
                items:1
            },
            480:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------

    // MENU
    // jQuery(document).ready(function($){
        $('#menu_offcanvas').SnsAccordion({
            accordion: false,
            expand: false,
            btn_open: '<i class="fa fa-plus"></i>',
            btn_close: '<i class="fa fa-minus"></i>'
        });
        $('#sns_mommenu .btn2.offcanvas').on('click', function(){
            if($('#menu_offcanvas').hasClass('active')){
                $(this).find('.overlay').fadeOut(250);
                $('#menu_offcanvas').removeClass('active');
                $('body').removeClass('show-sidebar');
            } else {
                $('#menu_offcanvas').addClass('active');
                $(this).find('.overlay').fadeIn(250);
                $('body').addClass('show-sidebar');
            }
        });
        // if($('#sns_right').length) {
        //     $('#sns_mommenu .btn2.rightsidebar').css('display', 'inline-block').on('click', function(){
        //         if($('#sns_right').hasClass('active')){
        //             $(this).find('.overlay').fadeOut(250);
        //             $('#sns_right').removeClass('active');
        //             $('body').removeClass('show-sidebar1');
        //         } else {
        //             $('#sns_right').addClass('active');
        //             $(this).find('.overlay').fadeIn(250);
        //             $('body').addClass('show-sidebar1');
        //         }
        //     });
        // }
        if($('#sns_left').length) {
            $('#sns_mommenu .btn2.leftsidebar').css('display', 'inline-block').on('click', function(){
                if($('#sns_left').hasClass('active')){
                    $(this).find('.overlay').fadeOut(250);
                    $('#sns_left').removeClass('active');
                    $('body').removeClass('show-sidebar1');
                } else {
                    $('#sns_left').addClass('active');
                    $(this).find('.overlay').fadeIn();
                    $('body').addClass('show-sidebar1');
                }
            });
        }
    // });
    // ----------AND----------------



    // ----------------sns_producttaps_wraps
    $('#sns_producttaps1 .precar').on('click', function(){
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $( "#sns_producttaps1" ).removeClass( "active" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('#sns_producttaps1 .nav-tabs').stop(true, true).slideUp("1400");
        } else {
            $(this).addClass('active');
            $( "#sns_producttaps1" ).addClass( "test" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('#sns_producttaps1 .nav-tabs').stop(true, true).slideDown("1400");
        }
    });
    // ----------AND----------------

    // ----------------sns_producttaps_wraps
    $('#sns_slider1_page2 .precar').on('click', function(){
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $( "#sns_slider1_page2" ).removeClass( "active" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('#sns_slider1_page2 .nav-tabs').stop(true, true).slideUp("1400");
        } else {
            $(this).addClass('active');
            $( "#sns_slider1_page2" ).addClass( "test" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('#sns_slider1_page2 .nav-tabs').stop(true, true).slideDown("1400");
        }
    });
    // ----------AND----------------

    // ----------------sns_producttaps_wraps
    $('#sns_slider2_page2 .precar').on('click', function(){
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $( "#sns_slider2_page2" ).removeClass( "active" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('#sns_slider2_page2 .nav-tabs').stop(true, true).slideUp("1400");
        } else {
            $(this).addClass('active');
            $( "#sns_slider2_page2" ).addClass( "test" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('#sns_slider2_page2 .nav-tabs').stop(true, true).slideDown("1400");
        }
    });
    // ----------AND----------------

    // ----------------sns_producttaps_wraps
    $('#sns_slider3_page2 .precar').on('click', function(){
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $( "#sns_slider3_page2" ).removeClass( "active" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('#sns_slider3_page2 .nav-tabs').stop(true, true).slideUp("1400");
        } else {
            $(this).addClass('active');
            $( "#sns_slider3_page2" ).addClass( "test" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('#sns_slider3_page2 .nav-tabs').stop(true, true).slideDown("1400");
        }
    });
    // ----------AND----------------

    // ----------------description
    $('#sns_description .detail-none').on('click', function(){
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $( ".description" ).removeClass( "active" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('.description .nav-tabs').stop(true, true).slideUp("1400");
        } else {
            $(this).addClass('active');
            $( ".description" ).addClass( "test" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('.description .nav-tabs').stop(true, true).slideDown("1400");
        }
    });
    // ----------AND----------------

    //-----------suggest collection
    $('#sns_suggest12 .fa').on('click', function(){
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $( ".sns_suggest" ).removeClass( "active" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('.sns_suggest .suggest-content').stop(true, true).slideUp("1400");
        } else {
            $(this).addClass('active');
            $( ".sns_suggest" ).addClass( "test" );
            $(this).find('[class*="fa-caret-"]').removeClass('fa-align-justify').addClass('fa-align-justify');
            $('.sns_suggest .suggest-content').stop(true, true).slideDown("1400");
        }
    });
    // ----------AND----------------

    // Slideshow
    $("#slider123").owlCarousel({
        responsive:{
            0:{
                items:1
            }
        },
        navigation: false,
        dots: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        loop: true
    });
    // ----------AND----------------

     // slider thumbail
    $("#sns_thumbail").owlCarousel({
        responsive:{
            0:{
                items:3
            },
            640:{
                items:4
            },
            768:{
                items:3
            },
            1000:{
                items:4
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        // singleItem: true,
        loop: true
    });
    // ----------AND----------------

     // blog
    $("#latestblog132").owlCarousel({
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        // singleItem: true,
        loop: true
    });
    // ----------AND----------------

     // sns-products-list
    $("#products_small").owlCarousel({
        responsive:{
            0:{
                items:1
            },
            530:{
                items:2
            },
            600:{
                items:2
            },
            800:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------

      // block-bestsaler
    $("#products_slider12").owlCarousel({
        responsive:{
             0:{
                items:1
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------

    // parner
    $("#partners_slider1").owlCarousel({
        responsive:{
            0:{
                items:2
            },
            480:{
                items:3
            },
            600:{
                items:4
            },
            980:{
                items:5
            },
            1000:{
                items:6
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------

    // categories
    $(".featured-slider").owlCarousel({
        responsive:{
            0:{
                items:1
            },
            480:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------

    // product_index
    $("#product_index, #product_index1, #product_index2").owlCarousel({
        responsive:{
            0:{
                items:1
            },
            480:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            },
            1200:{
                items:5
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------

    // related_upsell
    $("#related_upsell").owlCarousel({
        responsive:{
            0:{
                items:1
            },
            480:{
                items:2
            },
            768:{
                items:3
            },
            1200:{
                items:4
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------

    // related_related
    $("#related_upsell1").owlCarousel({
        responsive:{
            0:{
                items:1
            },
            480:{
                items:2
            },
            768:{
                items:3
            },
            1200:{
                items:4
            }
        },
        navigation: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true
    });
    // ----------AND----------------
});