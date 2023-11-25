(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {

        var debounce = debounce || function (func, wait, immediate) {
            var timeout;
            return function() {
                var context = this, args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        };

        function hideAll() {
            $("[data-toggle=popover]").each(function () {
                var popover = $(this).data('bs.popover');
                if (popover.tip().is(':visible')) popover.hide();
            });
        }

        $("[data-toggle=popover]")
            .popover({animation: false, container: document.body, delay: 50, html: true, trigger: 'manual', placement: 'top'})
            .each(function () {
                var popover = $(this).data('bs.popover');
                var $tip = popover.tip();
                var delay = popover.options.delay || 0;
                var showDelay = delay.show || delay || 0;
                var hideDelay = delay.hide || delay || 0;
                var showTimeout = null
                var hideTimeout = null;


                $(this).add($tip).hover(function show() {
                    if (hideTimeout) {
                        clearTimeout(hideTimeout);
                        hideTimeout = null;
                    } else if (!$tip.is(':visible')) {
                        hideAll();
                        showTimeout = setTimeout(function () {
                            popover.show();
                            showTimeout = null;
                        }, showDelay);
                    }
                }, function hide() {
                    if (showTimeout) {
                        clearTimeout(showTimeout);
                        showTimeout = null;
                    } else if ($tip.is(':visible')) {
                        hideTimeout = setTimeout(function () {
                            popover.hide();
                            hideTimeout = null;
                        }, hideDelay);
                    }
                });
            });

        $(window).on('scroll resize', debounce(hideAll, 100, true));



        $('.shippingCheck').click(function () {
            $('.shipping-details-area').toggle();

            if ($('.shipping-details-area').is(':hidden')) {
                $('.shipping-details-area').find('input').prop('required', false);
            } else {
                $('.shipping-details-area').find('input').prop('required', true);
            }
        });

        $(".product-carousel-list").owlCarousel({
            items: 4,
            autoplay: true,
            margin: 60,
            loop: true,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 3,
                },
                1200: {
                    items: 4
                }
            }

        });

        $(".product-review-owl-carousel").owlCarousel({
            items: 4,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            dots: false,
            loop: true,
            autoplay: true,
            smartSpeed: 800

        });

        $('.product-zoom').zoom({
            on: 'click',
            magnify: 2,
            onZoomIn: function () {
                $(this).css('cursor', 'zoom-out');
            },
            onZoomOut: function () {
                $(this).css('cursor', 'zoom-in');
            }
        });


        $(".blog-area-slider").owlCarousel({
            items: 3,
            autoplay: true,
            margin: 60,
            loop: true,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            smartSpeed: 800,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 3
                }
            }
        });

        $(".logo-carousel").owlCarousel({
            loop: true,
            autoWidth: true,
            items: 7,
            nav: true,
            dots: false,
            margin: 30,
            autoplay: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            smartSpeed: 300,
            responsive: {
                0: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 7
                }
            }
        });

        $(".testimonial-section").owlCarousel({
            items: 1,
            autoplay: 3000,
            margin: 60,
            loop: true,
            nav: true,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
            smartSpeed: 800
        });

        new WOW().init();
        getCart();

    });

    $("#searchbtn").click(function () {
        if ($("#searchdata").val() != "") {
            window.location = mainurl + "/search/" + $("#searchdata").val();
        } else {
            window.location = mainurl + "/search/none";
        }
    });

    $("#searchdata").keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            if ($("#searchdata").val() != "") {
                window.location = mainurl + "/search/" + $("#searchdata").val();
            } else {
                window.location = mainurl + "/search/none";
            }

        }
    });

    $('#product-size span').click(function () {
        $('#product-size span').removeClass('selected-size');
        $(this).addClass('selected-size');
        var size = $(this).html();
        $('#size').val(size);
    });

    $('#qty-add').click(function () {
        var qty = parseInt($('#pqty').text());
        var total = qty + 1;
        $('#pqty').text(total);
        $('#quantity').val(total);
        var price = parseFloat($('#price').val());
        var cost = parseFloat(total) * price;
        $('#cost').val(cost.toFixed(2));
    });

    $('#qty-minus').click(function () {
        var qty = parseInt($('#pqty').text());
        var total = qty - 1;
        $('#pqty').text(total < 1 ? 1 : total);
        $('#quantity').val(total);
        var price = parseFloat($('#price').val());
        var cost = parseFloat(total) * price;
        $('#cost').val(cost.toFixed(2));
    });

    $('.quantity-cart-plus').on('click', function () {
        var id = parseInt($(this).attr('id').replace(/[^\d.]/g, ''));
        var prices = parseFloat($('#price' + id).html().replace(/[^\d.]/g, ''));
        var quan = parseInt($('#number' + id).html().replace(/[^\d.]/g, ''));
        //alert(quan);

        var total = quan + 1;
        $('#number' + id).text(total < 1 ? 1 : total);

        var ttl = prices * total;
        $('#cost' + id).val(ttl.toFixed(2));
        $('#quantity' + id).val(total);
        $('#subtotal' + id).html(ttl.toFixed(2));
        var sum = 0;
        $('.subtotal').each(function () {
            sum += parseFloat($(this).text().replace(/[^\d.]/g, ''));  // Or this.innerHTML, this.innerText
        });
        $('#grandtotal').html(sum);

        if ($("#citem" + id).length !== 0) {
            var formData = $("#citem" + id).serializeArray();
            $.ajax({
                type: "POST",
                url: mainurl + '/cartupdate',
                data: formData,
                success: function (data) {
                    getCart();
                },
                error: function (data) {
                    //console.log('Error:', data);
                }
            });
        }

    });

    $('.quantity-cart-minus').on('click', function () {
        var id = parseInt($(this).attr('id').replace(/[^\d.]/g, ''));
        var prices = parseFloat($('#price' + id).html().replace(/[^\d.]/g, ''));
        var quan = parseInt($('#number' + id).html().replace(/[^\d.]/g, ''));
        //alert(quan);

        var total = quan - 1;
        if (total >= 1) {
            $('#number' + id).text(total);

            var ttl = prices * total;
            $('#cost' + id).val(ttl.toFixed(2));
            $('#quantity' + id).val(total);
            $('#subtotal' + id).html(ttl.toFixed(2));
            var sum = 0;
            $('.subtotal').each(function () {
                sum += parseFloat($(this).text().replace(/[^\d.]/g, ''));  // Or this.innerHTML, this.innerText
            });
            $('#grandtotal').html(sum);

            if ($("#citem" + id).length !== 0) {
                var formData = $("#citem" + id).serializeArray();
                $.ajax({
                    type: "POST",
                    url: mainurl + '/cartupdate',
                    data: formData,
                    success: function (data) {
                        getCart();
                    },
                    error: function (data) {
                        //console.log('Error:', data);
                    }
                });
            }
        }


    });


    $("#ex2").slider({});
    $("#ex2").on("slide", function (slideRange) {
        var totals = slideRange.value;
        var value = totals.toString().split(',');
        $("#price-min").val(value[0]);
        $("#price-max").val(value[1]);
    });

    jQuery(window).load(function () {
        setTimeout(function () {
            $('#cover').fadeOut(500);
        }, 500);
    });


}(jQuery));

function productGallery(file) {
    var image = $("#" + file).attr('src');
    $('#imageDiv').attr('src', image);
    $('.zoomImg').attr('src', image);
}

function getQuickView(id) {
    var product = id.toString();
    $.get(mainurl + '/quick-view/' + product, function (response) {
        $('#viewProduct').html(response);
    });
}

//Cart System By ShaOn//

function getCart() {
    $.get(mainurl + '/cartupdate', function (response) {
        var total = 0;
        $("#goCart").html('');
        $.each(response, function (i, cart) {
            $.each(cart, function (index, data) {
                //for (var i = 0; i <= index; i++){
                var title = data.title.toLowerCase();
                title = title.split(' ').join('-');
                url = mainurl + '/product/' + data.product + '/' + title;
                total = parseFloat(total) + parseFloat(data.cost);
                $("#goCart").append('<div class="cart-entry"> <div class="content"> <a class="title" href="' + url + '">' + data.title + '</a> <div class="quantity">' + language.quantity + ': ' + data.quantity + '</div><div class="price">' + currency + data.cost + '</div></div><div class="button-x"><i class="fa fa-close" onclick=" getDelete(' + data.product + ')"></i></div></div>');
                $('#grandttl').html(currency + total.toFixed(2));
                $('#carttotal').html(currency + total.toFixed(2));
                $('#emptycart').html('');
                //console.log('index', data);
                //}
            })
        })
    });
}

function getDelete(id) {
    $.getJSON(mainurl + '/cartdelete/' + id, function (response) {
        $('#grandttl').html(currency + '0.00');
        $('#carttotal').html(currency + '0.00');
        $('#grandtotal').html('0.00');
        $('#emptycart').html(language.empty_cart);
        $('#cartempty').html('<td><h3>' + language.empty_cart + '</h3></td>');
        $('#item' + id).remove();
        var total = 0;
        var url = '';
        $("#goCart").html('');
        $.each(response, function (i, cart) {
            $.each(cart, function (index, data) {
                //for (var i = 0; i <= index; i++){
                var title = data.title.toLowerCase();
                title = title.split(' ').join('-');
                url = mainurl + '/product/' + data.product + '/' + title;
                total = parseFloat(total) + parseFloat(data.cost);
                $("#goCart").append('<div class="cart-entry"> <div class="content"> <a class="title" href="' + url + '">' + data.title + '</a> <div class="quantity">' + language.quantity + ': ' + data.quantity + '</div><div class="price">' + data.cost + ' FCFA</div></div><div class="button-x"><i class="fa fa-close" onclick=" getDelete(' + data.product + ')"></i></div></div>');
                $('#grandttl').html(currency + total.toFixed(2));
                $('#carttotal').html(currency + total.toFixed(2));
                $('#grandtotal').html(total.toFixed(2));
                $('#emptycart').html('');
                $('#cartempty').html('');
                //console.log('index', data);
                //}
            })
        })
    });
}

$(".to-cart").click(function () {

    var formData = $(this).parents('form:first').serializeArray();
    $.ajax({
        type: "POST",
        url: mainurl + '/cartupdate',
        data: formData,
        success: function (data) {
            getCart();
            $.notify(language.added_to_cart, "success");
        },
        error: function (data) {
            //console.log('Error:', data);
        }
    });
});

function toCart(btn) {
    var formData = $(btn).parents('form:first').serializeArray();
    $.ajax({
        type: "POST",
        url: mainurl + '/cartupdate',
        data: formData,
        success: function (data) {
            getCart();
            //alert("Added to Cart: " + data.product);
            $.notify(language.added_to_cart, "success");
        },
        error: function (data) {
            //console.log('Error:', data);
        }
    });
}

function toAddCartFromTable(elem) {
    var token = { name: '_token', value: $(elem).closest('tr').find('.token').val() };
    var uniqueid = { name: 'uniqueid', value: $(elem).closest('tr').find('.uniqueid').val() };
    var quantity = { name: 'quantity', value: $(elem).closest('tr').find('.quantity').val() };
    var price = { name: 'price', value: $(elem).closest('tr').find('.price').val() };
    var title = { name: 'title', value: $(elem).closest('tr').find('.title').val() };
    var product = { name: 'product', value: $(elem).closest('tr').find('.product').val() };
    var cost = { name: 'cost', value: $(elem).closest('tr').find('.cost').val() };
    var size = { name: 'size', value: $(elem).closest('tr').find('.size').val() };

    product_data = [token, uniqueid, quantity, price, title, product, cost, size];
    // console.log(product_data)
    $.ajax({
        type: "POST",
        url: mainurl + '/cartupdate',
        data: product_data,
        success: function (data) {
            // console.log(data)
            $.ajax({
                type: "GET",
                url: mainurl + '/getcartdata',
                data: { _token: token },
                success: function (response) {
                    // console.log(response)
                    var trows, subtotal, totalTable;
                    // <img class='credit-sign' src='" + mainurl + '/assets2/images/rsign.png' + "  ' }}'>
                    $.each(response, function (i, product) {
                        trows += "<tr><td><a href='" + mainurl + "/product/" + product.product + "/" + product.title.toLowerCase().replace(' ', '-') + "'>" + product.title +
                            "</a>" +
                            "</td>" +
                            "<td class='text-center'>" +
                            product.quantity +
                            "</td>" +
                            "<td class='text-left'>$" + parseFloat(product.cost).toFixed(2) +
                            "</td>" +
                            "<td class='text-center'>$" +
                            parseFloat(product.cost * product.quantity).toFixed(2) +
                            "</td>" +
                            "<td>" +
                            "<form action='" + mainurl + '/cartdelete/product/' + product.product + "' method='GET'>" +
                            "<input type='hidden' name='_token' value='" + token + "'>" +
                            "<button class='btn-remove' title='Remove This Item' type='submit' style='margin-top:-5px;'>Remove This Item</button>" +
                            "</form>" +
                            "</td>" +
                            "</tr>";
                    });

                    var price = 0, items = 0, discount = 0;
                    $.each(response, function (x, item) {
                        price += item.cost * item.quantity;
                        items += item.quantity;
                    });

                    if (discount_type === 'fixed') {
                        discount = price < discount_value ? price : discount_value;
                    } else if (discount_type === 'percent') {
                        discount = (discount_value / 100) * price;
                    }

                    var grandTotal = ((price + delivery_fee) * 13) / 100 + price - discount + delivery_fee + donation_amount;

                    $("#cartProductTable").find("#cartproductList").html(trows);
                    if (response.length > 0) {
                        $("#cartProductTable").find("#cartSummarySubtotal").html('$' + parseFloat(price).toFixed(2));
                        $("#cartProductTable").find("#cartSummaryDiscount").html('- $' + parseFloat(discount).toFixed(2));
                        $("#cartProductTable").find("#cartSummaryDelivery").html('$' + parseFloat(delivery_fee).toFixed(2));
                        $("#cartProductTable").find("#cartSummaryTax").html('$' + parseFloat((price + delivery_fee) * 13 / 100).toFixed(2));
                        $("#cartProductTable").find("#cartSummaryGrandTotal").html('$' + parseFloat(grandTotal).toFixed(2));
                        $("#cartProductTable").find("#cartSummary").removeClass('hidden');
                    } else {
                        $("#cartProductTable").find("#cartSummary").addClass('hidden');
                    }

                    subtotal = "<span class='label'>Total:</span> " +
                        "<span class='price'>$" + parseFloat(grandTotal).toFixed(2) +
                        "</span>";

                    $(".cart-subtotal").html('');
                    $(".cart-subtotal").append(subtotal);

                    var tongle = " items &nbsp; | &nbsp;<b> $";

                    $(".top-cart .tongle").html("");
                    $(".top-cart .tongle").append(items + tongle + parseFloat(grandTotal).toFixed(2) + "</b> <i class='fa fa-shopping-cart cart-icon' style='margin-top: 0px; padding-top: 0px;'></i>");

                    var tongleFooter = " ITEMS | <b> $";

                    $(".top-icons .tongle").html("");
                    $(".top-icons .tongle").append(items + tongleFooter + parseFloat(grandTotal).toFixed(2) + "</b>");
                }
            });
            $.notify({
                // options
                icon: 'fas fa-check',
                title: '',
                message: language.added_to_cart,
                // url: 'https://github.com/mouse0270/bootstrap-notify',
                // target: '_blank'
            }, {
                // settings
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: true,
                showProgressbar: false,
                placement: {
                    from: "bottom",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                // url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class',
                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message" style="font-weight: 600;">{2}</span>' +
                    '</div>'
            });
        },
        error: function (data) {
            //console.log('Error:', data);
        }
    });
}

function toAddCartFromProduct(elem) {
    var token = { name: '_token', value: $(elem).closest('.addtocart-form').find('.token').val() };
    var uniqueid = { name: 'uniqueid', value: $(elem).closest('.addtocart-form').find('.uniqueid').val() };
    var quantity = { name: 'quantity', value: $(elem).closest('.addtocart-form').find('.quantity').val() };
    var price = { name: 'price', value: $(elem).closest('.addtocart-form').find('.price').val() };
    var title = { name: 'title', value: $(elem).closest('.addtocart-form').find('.title').val() };
    var product = { name: 'product', value: $(elem).closest('.addtocart-form').find('.product').val() };
    var cost = { name: 'cost', value: $(elem).closest('.addtocart-form').find('.cost').val() };
    var size = { name: 'size', value: $(elem).closest('.addtocart-form').find('.size').val() };

    product_data = [token, uniqueid, quantity, price, title, product, cost, size];
    // console.log(product_data)
    $.ajax({
        type: "POST",
        url: mainurl + '/cartupdate',
        data: product_data,
        success: function (data) {
            // console.log(data)
            $.ajax({
                type: "GET",
                url: mainurl + '/getcartdata',
                data: { _token: token },
                success: function (response) {
                    // console.log(response)
                    var trows, subtotal, totalTable;
                    // <img class='credit-sign' src='" + mainurl + '/assets2/images/rsign.png' + "  ' }}'>
                    $.each(response, function (i, product) {
                        trows += "<tr><td><a href='" + mainurl + "/product/" + product.product + "/" + product.title.toLowerCase().replace(' ', '-') + "'>" + product.title +
                            "</a>" +
                            "</td>" +
                            "<td class='text-center'>" +
                            product.quantity +
                            "</td>" +
                            "<td class='text-left'>$" + parseFloat(product.cost).toFixed(2) +
                            "</td>" +
                            "<td class='text-center'>$" +
                            parseFloat(product.cost * product.quantity).toFixed(2) +
                            "</td>" +
                            "<td>" +
                            "<form action='" + mainurl + '/cartdelete/product/' + product.product + "' method='GET'>" +
                            "<input type='hidden' name='_token' value='" + token + "'>" +
                            "<button class='btn-remove' title='Remove This Item' type='submit' style='margin-top:-5px;'>Remove This Item</button>" +
                            "</form>" +
                            "</td>" +
                            "</tr>";
                    });

                    var price = 0, items = 0, discount = 0;
                    $.each(response, function (x, item) {
                        price += item.cost * item.quantity;
                        items += item.quantity;
                    });

                    if (discount_type === 'fixed') {
                        discount = price < discount_value ? price : discount_value;
                    } else if (discount_type === 'percent') {
                        discount = (discount_value / 100) * price;
                    }

                    var grandTotal = ((price + delivery_fee) * 13) / 100 + price - discount + delivery_fee + donation_amount;

                    $("#cartProductTable").find("#cartproductList").html(trows);
                    if (response.length > 0) {
                        $("#cartProductTable").find("#cartSummarySubtotal").html('$' + parseFloat(price).toFixed(2));
                        $("#cartProductTable").find("#cartSummaryDiscount").html('- $' + parseFloat(discount).toFixed(2));
                        $("#cartProductTable").find("#cartSummaryDelivery").html('$' + parseFloat(delivery_fee).toFixed(2));
                        $("#cartProductTable").find("#cartSummaryTax").html('$' + parseFloat((price + delivery_fee) * 13 / 100).toFixed(2));
                        $("#cartProductTable").find("#cartSummaryGrandTotal").html('$' + parseFloat(grandTotal).toFixed(2));
                        $("#cartProductTable").find("#cartSummary").removeClass('hidden');
                    } else {
                        $("#cartProductTable").find("#cartSummary").addClass('hidden');
                    }

                    subtotal = "<span class='label'>Total:</span> " +
                        "<span class='price'>$" + parseFloat(grandTotal).toFixed(2) +
                        "</span>";

                    $(".cart-subtotal").html('');
                    $(".cart-subtotal").append(subtotal);

                    var tongle = " items &nbsp; | &nbsp;<b> $";

                    $(".top-cart .tongle").html("");
                    $(".top-cart .tongle").append(items + tongle + parseFloat(grandTotal).toFixed(2) + "</b> <i class='fa fa-shopping-cart cart-icon' style='margin-top: 0px; padding-top: 0px;'></i>");

                    var tongleFooter = " ITEMS | <b> $";

                    $(".top-icons .tongle").html("");
                    $(".top-icons .tongle").append(items + tongleFooter + parseFloat(grandTotal).toFixed(2) + "</b>");
                }
            });
            $.notify({
                // options
                icon: 'fas fa-check',
                title: '',
                message: language.added_to_cart,
                // url: 'https://github.com/mouse0270/bootstrap-notify',
                // target: '_blank'
            }, {
                // settings
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: true,
                showProgressbar: false,
                placement: {
                    from: "bottom",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                // url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class',
                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message" style="font-weight: 600;">{2}</span>' +
                    '</div>'
            });
        },
        error: function (data) {
            //console.log('Error:', data);
        }
    });
}

//Subscription Button
$("#subs").click(function () {
    var datas = $('#subform').serializeArray();
    var action = $('#subform').attr('action');
    $.post(action, datas, function (data, textStatus, xhr) {
        setTimeout(function () {
            $("#resp").html(data);
        }, 1000);
    });
    return false;
});

$(function () {

    var current = location.pathname;
    $('.dashboard-mainmenu li a').each(function () {
        var $this = $(this);
        // if the current path is like this link, make it active
        if ($this.attr('href').indexOf(current) !== -1) {
            $this.parents('li').addClass('active');
        }
    })
});

//Start Review Scripts Start
var slice = [].slice;

(function ($, window) {
    var Starrr;
    window.Starrr = Starrr = (function () {
        Starrr.prototype.defaults = {
            rating: void 0,
            max: 5,
            readOnly: false,
            emptyClass: 'fa fa-star-o',
            fullClass: 'fa fa-star',
            change: function (e, value) { }
        };

        function Starrr($el, options) {
            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            this.createStars();
            this.syncRating();
            if (this.options.readOnly) {
                return;
            }
            this.$el.on('mouseover.starrr', 'a', (function (_this) {
                return function (e) {
                    return _this.syncRating(_this.getStars().index(e.currentTarget) + 1);
                };
            })(this));
            this.$el.on('mouseout.starrr', (function (_this) {
                return function () {
                    return _this.syncRating();
                };
            })(this));
            this.$el.on('click.starrr', 'a', (function (_this) {
                return function (e) {
                    return _this.setRating(_this.getStars().index(e.currentTarget) + 1);
                };
            })(this));
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.getStars = function () {
            return this.$el.find('a');
        };

        Starrr.prototype.createStars = function () {
            var j, ref, results;
            results = [];
            for (j = 1, ref = this.options.max; 1 <= ref ? j <= ref : j >= ref; 1 <= ref ? j++ : j--) {
                results.push(this.$el.append("<a href='javascript:;' />"));
            }
            return results;
        };

        Starrr.prototype.setRating = function (rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.getRating = function () {
            return this.options.rating;
        };

        Starrr.prototype.syncRating = function (rating) {
            var $stars, i, j, ref, results;
            rating || (rating = this.options.rating);
            $stars = this.getStars();
            results = [];
            for (i = j = 1, ref = this.options.max; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
                results.push($stars.eq(i - 1).removeClass(rating >= i ? this.options.emptyClass : this.options.fullClass).addClass(rating >= i ? this.options.fullClass : this.options.emptyClass));
            }
            return results;
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function () {
            var args, option;
            option = arguments[0], args = 2 <= arguments.length ? slice.call(arguments, 1) : [];
            return this.each(function () {
                var data;
                data = $(this).data('starrr');
                if (!data) {
                    $(this).data('starrr', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);


$(function () {

    "use strict";

    /*================*/
    /* 01 - VARIABLES */
    /*================*/
    var swipers = [], winW, winH, winScr, _isresponsive, intPoint = 500, smPoint = 768, mdPoint = 992, lgPoint = 1200, addPoint = 1600, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

    $('#mobileNav li i').on('click', function () {

        // if (_isresponsive) {
        // alert()
        $(this).next('.submenu').slideToggle();
        $(this).parent().toggleClass('opened');
        // }
    });

    $('#mobileNav .submenu-list-title .toggle-list-button').on('click', function () {
        // if (_isresponsive) {
        $(this).parent().next('.toggle-list-container').slideToggle();
        $(this).parent().toggleClass('opened');
        // }
    });
});

