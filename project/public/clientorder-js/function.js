$(document).ready(function(){
    if (window.errorCaptcha) {
        $('#wizard-form .steps li').removeClass('active');
        $('#wizard-form .steps li[data-target="step4"]').addClass('active');
        $('#main-form .step-pane').hide();
        $('#main-form .step4').show();
    }
	$(document).on('click','.btn-next',function(){
		if($('#main-form').valid())
		{
			var next = $(this).attr('data-next');
			$('#wizard-form .steps li').removeClass('active');
			$('#wizard-form .steps li[data-target="'+next+'"]').addClass('active');
			$('#main-form .step-pane').hide();
			$('#main-form .'+next+'').show();
		}
	});
	$(document).on('click','.btn-prev',function(){
		var prev = $(this).attr('data-back');
		$('#wizard-form .steps li').removeClass('active');
		$('#wizard-form .steps li[data-target="'+prev+'"]').addClass('active');
		$('#main-form .step-pane').hide();
		$('#main-form .'+prev+'').show();
	});
	$(document).on('click','.post-time label',function(){
		$('.post-time label').removeClass('active');
		$(this).find('.postingtimes').prop( "checked",true );
		$(this).addClass('active');
		if($(this).attr('id')=='specific_date'){
			$('.post-time-content-outer').show();
		}
		else
			$('.post-time-content-outer').hide();
	});
	$('#specificpost_date').pickadate();

    // function formValidateStep1() {
    //     $.ajax({
    //         method: "POST",
    //         url: "/shredding-quote_canada/validation.php",
    //         data: {
    //             address: $('#address').val(),
    //             street_no: $('#street_no').val(),
    //             unit: $('#unit').val(),
    //             city: $('#city').val(),
    //             zip: $('#zip').val(),
    //         }
    //     })
    // }

    //function formValidateStep2() {
    //    $.ajax({
    //        method: "POST",
    //        url: "/validation.php",
    //        data:
    //    })
    //}
    //
    //function formValidateStep3() {
    //    $.ajax({
    //        method: "POST",
    //        url: "/validation.php",
    //        data:
    //    })
    //}
});
