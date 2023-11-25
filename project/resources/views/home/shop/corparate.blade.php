@extends('home.shop.includes.master',['cart_result'=> $response])

@section('header')
@include('home.shop.includes.header')
@stop

@section('content')
<!-- BEGIN INTRO CONTENT -->
<section class="p-b-65 p-t-100 m-t-50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-t-5 fs-24" style="color: #2988be;">CORPORATE MASKS</h4>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <!-- <table class="table table-bordered" style="width: 100%;">
                     <thead>
                         <tr>
                             <td width="70%"></td>
                             <td width="30%">
                                 <h2>Protect Your Employees.</h2><br>
                                 <h2>Protect Your Customers.</h2><br>
                                 <h2>Protect Your Brand.</h2>
                             </td>
                         </tr>
                         </tbody>
                 </table> -->
                <p class="m-t-15 fs-15">
                    Protective Face Masks is now a general requirement for the general public and business
                    environments.
                </p>
                <p class="m-t-15 fs-15">
                    We provide two types of custom solutions of protective face wear:
                </p>
                <br>
                <ul>
                    <li>
                        <h4 style="font-weight: 700;">Disposable Face Masks</h4>
                    </li>
                    <p class="m-t-15 fs-15">
                        Our DayGuard® Mask is a single-use, three-ply pleated face mask, made from latex-free,
                        non-woven, hypoallergenic polypropylene to offer comfort, fit and reliable protection from
                        airborne contaminants. The facemask exhibits an excellent water vapor transmission rate and
                        particle filtration down to 0.1 micron. The DayGuard face mask has soft, latex-free,
                        non-irritating, woven ear loops that are ultrasonically welded to the mask to prevent
                        breakage, even with the most strenuous activity.
                    </p>
                    <li class="m-t-30">
                        <h4 style="font-weight: 700;">Reusable Face Masks with Filters</h4>
                    </li>
                    <p class="m-t-15 fs-15">
                        Our ProFlex® Face Masks are made from 100% Cotton, designed for durability, with daily use
                        and comes with replacable filters.
                    </p>
                    <ul class="m-t-30" style="list-style: none;">
                        <li>
                            <h5 style="font-weight: 700;">Filtration technology</h5>
                        </li>
                        <p class="m-t-15 fs-15">
                            Our filters are made of activated carbon and non-woven melt-blown filter cloth. This
                            five-layer system has filtration efficiency of 95%+, with PM2.5 classification. This
                            means it can filter airborne pollutants as small as 0.001 millimeters.
                        </p>
                        <li class="m-t-30">
                            <h5 style="font-weight: 700;">Application and Usage</h5>
                        </li>
                        <p class="m-t-15 fs-15">
                            In addition to health protection from water droplets, our masks also protect against
                            airborne particle dust, seasonal allergies, smoke, pollution, ash, pollens etc. The
                            recommended use is daily washing, and filters to be changed weekly.
                        </p>
                        <li class="m-t-30">
                            <h5 style="font-weight: 700;">Features:</h5>
                        </li>
                        <ul style="list-style: circle;">
                            <li>Adjustable Elastic Earloops</li>
                            <li>100% Cotton </li>
                            <li>PM 2.5 Filters</li>
                            <li>Custom Logo Branding</li>
                        </ul>
                    </ul>
                </ul>
                <p class="m-t-30 fs-15">
                    Our masks are suitable for a wide range of applications including:
                </p>
                <ul>
                    <li>Field Service</li>
                    <li>Hospitality</li>
                    <li>Healthcare</li>
                    <li>Security</li>
                    <li>Logistics</li>
                    <li>Beauty and Wellness</li>
                </ul>
            </div>
            <div class="col-md-12 m-t-30">
                <h4 class="m-t-5 fs-24" style="color: #2988be;">Recommended Programs</h4>

                <p class="m-t-30 fs-15">
                    For our corporate clients We recommend a comprehensive Face Protection Program, that combines
                    the use of both disposable and reusable face masks.
                </p>

                <h5 class="m-t-30" style="font-weight: 700;">Employees</h5>
                <p class="m-t-15 fs-15">For every employee, we recommend:</p>
                <ul>
                    <li>Three (3) Reusable Masks</li>
                    <li>20 Filters Per month</li>
                </ul>

                <h5 class="m-t-30" style="font-weight: 700;">For Customers</h5>
                <ul>
                    <li>Maintain a stock on hand of at least 10x your average foot traffic per week.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@stop

@section('footer')
@include('home.shop.includes.footer')
@stop