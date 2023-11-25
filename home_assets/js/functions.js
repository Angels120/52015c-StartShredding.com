$(document).on('click', '.post-time label', function() {
    $('.post-time label').removeClass('active');
    $(this).find('.postingtimes').prop("checked", true);
    $(this).addClass('active');
    if ($(this).attr('id') == 'specific_date') {
        $('.post-time-content-outer').show();
    } else
        $('.post-time-content-outer').hide();
});


