$(document).ready(function() {
	// $('.nice_scroll').niceScroll();
// Sidebar Open
$('#navbarOpen').click(function() {
	$(this).addClass('navbarActive');
	$('#sidebar').addClass('navbarActive');
	$('.overlay-img').addClass('navbarActive');
});
// Sidebar Close
$('#navbarClose').click(function() {
	$(this).removeClass('navbarActive');
	$('#navbarOpen').removeClass('navbarActive');
	$('#sidebar').removeClass('navbarActive');
	$('.overlay-img').removeClass('navbarActive');
});

// prodotti Gallery
$('.product_box').click(function(event) {
	if ($(this).hasClass("active")) {
		$(this).removeClass('active');
		$('.products-box').removeClass('active');
		$('.products-modal').removeClass('active');
	}else {
		$('.product_box').removeClass('active');
		$('.products-modal').removeClass('active');
		$('.products-box').addClass('active');
		$(this).addClass('active');
		var anchor = $(this).attr('data-slide');
		$('#'+anchor).addClass('active');
	}
});
$('.btn-close').click(function(event) {
	if ($('.products-modal').hasClass("active")) {
		$('.products-box').removeClass('active');
		$('.product_box').removeClass('active');
		$('.products-modal').removeClass('active');
	}
});
//initialize swiper when document ready
var mySwiper = new Swiper ('.swiper-container', {
    spaceBetween: 22,
    zoom: false,
    loop: true,
    centeredSlides:true,
    slidesPerView:'auto',
    navigation: {
    	nextEl: '.swiper-button-next',
    	prevEl: '.swiper-button-prev',
    },
})

});