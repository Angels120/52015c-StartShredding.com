<style>
@media (max-width: 800px) {
    .narrow {
      display: block
    }
    .line_1 {
        display: none
    }
    .footer_lines {
        text-align: center;
        padding-bottom: 10px;
    }
  }
</style>
<?php 
$ip =  $_SERVER['REMOTE_ADDR'];
$ip_info = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));  
?>
<section class="p-t-10 p-b-10 bg-master-darkest">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-6">
                <p class="fs-11 no-margin font-arial text-white small-text footer_lines" >{{$ip_info->geoplugin_city?$ip_info->geoplugin_city:'Toronto'}} Shredding Service <span class="line_1">|</span><span class="narrow"></span> {{$ip_info->geoplugin_regionName?$ip_info->geoplugin_regionName:'Ontario'}} Shredding
                </p>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-6">
                <p align="right" class="fs-11 no-margin font-arial text-white small-text footer_lines">Copyright @ {{date("Y")}} Start Shredding Inc.<span class="narrow"></span>  All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</section>