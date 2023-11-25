/*
	Author: Umair Chaudary @ Pixel Art Inc.
	Author URI: http://www.pixelartinc.com/
*/




$(document).ready(function(e) {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 16000,
      values: [ 1250, 9999 ],
      slide: function( event, ui ) {
        $( "#amount-1" ).val(ui.values[ 0 ]);
        $( "#amount-2" ).val(ui.values[ 1 ] );
    }
});
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});

