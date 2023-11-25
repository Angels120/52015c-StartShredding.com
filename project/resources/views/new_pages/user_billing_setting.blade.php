@extends('new_includes.new_main')

@section('title','| HomePage')


    
@section('content')
    <!-- START PAGE CONTENT -->
    <div class="content ">
        <!-- START JUMBOTRON -->
       
        <!-- END JUMBOTRON -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid m-t-40">
            <!-- START card -->
            <div class="card card-default">
                <!-- <div class="card-header separator">
                     <div class="card-title">
                         <h5><strong>Transaction Details</strong></h5>

                     </div>
                 </div>-->
                <!-- <div class="card-body p-t-20">-->
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="invoice padding-20 sm-padding-10">

                                <div class="card-body p-t-20">
                                    <form action="">
                                        <div class="row justify-content-left">
                                            <div class="col-md-7">
                                                <div class="form-group" style="display: inline-block">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4><b>Account Balance</b></h4>
                                                            <p>CUSTOMER#0000123456789 <br>January 12,2019</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">

                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group" style="display: inline-block">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 style="color: #6232a8!important;">$84.67</h4>
                                                            <div class="btn-group">
                                                                <a href="#!" style="background-color: #6232a8!important;" class="btn btn-success"><font style="font-size: 10px !important;">ADD CREDITS</font>
                                                                </a>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <hr>
                                    <div class="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-clr">MANAGE WALLET</label>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-clr font-sz">BACKPOCKET EMAIL </label>
                                            <div class="form-group form-group-default">
                                                <input type="text" nname="route" id="route" value="" class="form-control" >
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label class="font-sz">ACCOUNT PIN/PASSWORD</label>
                                            <div class="form-group form-group-default">
                                                <input type="text" nname="route" id="route" value="" class="form-control" >
                                            </div>
                                        </div> <div class="col-md-5">
                                            <label class="font-clr">&nbsp</label>
                                            <div class="btn-group">
                                                    <a href="#!" style="background-color: #a832a4!important;" class="btn btn-success btn-size"><font style="font-size: 10px !important;">SAVE CHANGES</font>
                                                    </a>

                                            </div>

                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-clr">MANAGE CARDS </label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="checkbox check-primary checkbox-circle">
                                                <input type="checkbox" checked="checked" value="1" id="checkbox9">
                                                <label for="checkbox9" style="font-size: 10px !important;">CARD# **** **** **** 7829</label>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="font-clr">&nbsp</label>
                                            <div class="btn-group">
                                                <a href="#!" style="background-color: #a832a4!important;" class="btn btn-success btn-size"><font style="font-size: 10px !important;">REMOVE</font>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-clr" style="color: #a832a4">ADD NEW CARD</label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-clr font-sz">CARDS# </label>
                                            <div class="form-group form-group-default">
                                                <input type="text" nname="route" id="route" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="font-clr font-sz">EXPIRY(MM/YY) </label>
                                            <div class="form-group form-group-default">
                                                <input type="text" nname="route" id="route" value="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="font-clr font-sz">CCV </label>
                                            <div class="form-group form-group-default">
                                                <input type="text" nname="route" id="route" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">

                                        </div>
                                        <div class="col-md-4">
                                            <div class="btn-group">
                                                <a href="#!" style="background-color: #a832a4!important; " class="btn btn-success btn-size"><font style="font-size: 10px !important;">ADD CARDS</font>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                        </div>
                                    </div>

                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="invoice padding-20 sm-padding-10">
                                <!--<div>
                                    <div class="row">
                                        <div class="col-md-4">

                                        </div>
                                        <div class="col-md-5"></div>
                                        <div class="col-md-3">
                                            <div class="sm-m-t-20">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>-->
                                <!--<div class="table-responsive table-invoice">
                                    <table class="table m-t-10">
                                        <thead>
                                        <tr>
                                            <th class="text-left">ITEM</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-right">AMOUNT</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="v-align-middle text-left">Product Name</td>
                                            <td class="v-align-middle text-center">1</td>
                                            <td class="v-align-middle text-right">$124.33</td>
                                        </tr>
                                        <tr>
                                            <td class="v-align-middle text-left">Product Name</td>
                                            <td class="v-align-middle text-center">1</td>
                                            <td class="v-align-middle text-right">$124.33</td>
                                        </tr>
                                        <tr>
                                            <td class="v-align-middle text-left">Product Name</td>
                                            <td class="v-align-middle text-center">1</td>
                                            <td class="v-align-middle text-right">$124.33</td>
                                        </tr>
                                        <tr>
                                            <td class="v-align-middle text-left">Product Name</td>
                                            <td class="v-align-middle text-center">1</td>
                                            <td class="v-align-middle text-right">$124.33</td>
                                        </tr>
                                        <tr>
                                            <td class="v-align-middle text-left">Product Name</td>
                                            <td class="v-align-middle text-center">1</td>
                                            <td class="v-align-middle text-right">$124.33</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>-->
                                <div class="card-body p-t-20">
                                    <form action="">
                                        <div class="row justify-content-left">
                                            <div class="col-md-6">
                                                <div class="form-group" style="display: inline-block">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4><b>Billing History</b></h4>
                                                            <p>Transactions</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="col-md-3">
                                                &lt;!&ndash; <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="text" name="reservation" id="daterangepicker"
                                                        class="form-control" value="08/01/2013 1:00 PM - 08/01/2013 1:30 PM">
                                                </div> &ndash;&gt;
                                               &lt;!&ndash; <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Quick Date</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control">
                                                            &lt;!&ndash; <option value="" selected disabled>Quick Date</option> &ndash;&gt;
                                                            <option value="">Today</option>
                                                            <option value="">This Week</option>
                                                            <option value="">This Month</option>
                                                            <option value="">This Year</option>
                                                        </select>
                                                    </div>
                                                </div>&ndash;&gt;
                                            </div>-->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="row">
                                                       <!-- <div class="col-md-12">
                                                            <input style="border-color:#8533ff !important " type="text" class="form-control" placeholder="SEARCH BY PRODUCT NAME">
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="display: inline-block">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="font-cl1">SHOW</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select style="border-color:#8533ff !important " class="form-control">
                                                                <option value="" selected disabled>25</option> ;
                                                                <option value="">25</option>
                                                                <option value="">50</option>
                                                                <option value="">75</option>
                                                                <option value="">100</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="font-cl1">ITEMS</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <hr>
                                    <div class="">
                                        <table class="table table-hover table-condensed table-responsive table-responsive"
                                               id="tableTransactions">
                                            <thead bgcolor="#1f217d">
                                            <tr>
                                                <!-- NOTE * : Inline Style Width For Table Cell is Required as it may differ from user to user
                                                Comman Practice Followed
                                                -->
                                                <th style="width:50%;"><font color="#fc7b03">Date</font></th>
                                                <th style="width: 50%;"><font color="#fc7b03">Ref#</font></th>
                                                <th style="width: 50%;"><font color="#fc7b03">Transaction</font></th>
                                                <th style="width: 50%;"><font color="#fc7b03">Amount</font></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="v-align-middle">mm/dd/yyy</td>
                                                <td class="v-align-middle">1523</td>
                                                <td class="v-align-middle">DEPOSIT</td>
                                                <td class="v-align-middle">$123.23</td>
                                            </tr>
                                            <tr>
                                                <td class="v-align-middle">mm/dd/yyy</td>
                                                <td class="v-align-middle">1523</td>
                                                <td class="v-align-middle">DEPOSIT</td>
                                                <td class="v-align-middle">$123.23</td>
                                            </tr>
                                            <tr>
                                                <td class="v-align-middle">mm/dd/yyy</td>
                                                <td class="v-align-middle">1523</td>
                                                <td class="v-align-middle">DEPOSIT</td>
                                                <td class="v-align-middle">$123.23</td>
                                            </tr>
                                            <tr>
                                                <td class="v-align-middle">mm/dd/yyy</td>
                                                <td class="v-align-middle">1523</td>
                                                <td class="v-align-middle">DEPOSIT</td>
                                                <td class="v-align-middle">$123.23</td>
                                            </tr>
                                            <tr>
                                                <td class="v-align-middle">mm/dd/yyy</td>
                                                <td class="v-align-middle">1523</td>
                                                <td class="v-align-middle">DEPOSIT</td>
                                                <td class="v-align-middle">$123.23</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--<div class="row">
                                        <div class="col-md-2">
                                            <input type="checkbox" value="1" id="checkbox1" required name="terms">
                                            <label for="checkbox1" class="text-info small"> <a href="http://backpocket.ca/terms.html"
                                                                                               class="text-info ">SELECT ALL</a></label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" value="1" id="checkbox1" required name="terms">
                                            <label for="checkbox1" class="text-info small"> <a href="http://backpocket.ca/terms.html"
                                                                                               class="text-info ">
                                                DESELECT</a></label>
                                        </div>

                                    </div>-->

                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="invoice padding-20 sm-padding-10">
                                <div class="card-body p-t-20">
                                    <form action="">
                                        <div class="row justify-content-left">
                                            <div class="col-md-6">
                                                <div class="form-group" style="display: inline-block">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4><b>ADD CREDITS</b></h4>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="row">
                                                       <!-- <div class="col-md-12">
                                                            <input style="border-color:#8533ff !important " type="text" class="form-control" placeholder="SEARCH BY PRODUCT NAME">
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-clr font-sz">Select the Package you Want to Purchase</label>
                                        </div>


                                    </div>
                                    <div class="row" style=" border: 1px solid black;">
                                        <div class="col-md-12">
                                            <div class="checkbox check-primary checkbox-circle">
                                                <input type="checkbox"  value="1" id="checkbox10">
                                                <label for="checkbox10" style="font-size: 10px !important;">CARD# **** **** **** 7829</label>
                                            </div>
                                            <hr>
                                            <div class="checkbox check-primary checkbox-circle">
                                                <input type="checkbox"  value="1" id="checkbox11">
                                                <label for="checkbox11" style="font-size: 10px !important;">CARD# **** **** **** 7829</label>
                                            </div>
                                            <hr>
                                            <div class="checkbox check-primary checkbox-circle">
                                                <input type="checkbox" value="1" id="checkbox12">
                                                <label for="checkbox12" style="font-size: 10px !important;">CARD# **** **** **** 7829</label>
                                            </div>
                                            <hr>
                                            <div class="checkbox check-primary checkbox-circle">
                                                <input type="checkbox"  value="1" id="checkbox13">
                                                <label for="checkbox13" style="font-size: 10px !important;">CARD# **** **** **** 7829</label>
                                            </div>

                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">

                                        </div>
                                        <div class="col-md-4">
                                            <div class="btn-group">
                                                <a href="#!" style="background-color: #6232a8!important; align:center" class="btn btn-success"><font style="font-size: 10px !important;">PURCHASE CREDITS</font>
                                                </a>

                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                        </div>

                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="checkbox13" style="font-size: 10px !important;">Please Confirm, you are purchasing X Credits for $XX.XX</label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">

                                        </div> <div class="col-md-4">
                                            <label class="font-clr">&nbsp</label>
                                            <div class="btn-group">
                                                <a href="#!" style="background-color: #a832a4!important;" class="btn btn-success btn-size"><font style="font-size: 10px !important;">CONFIRM</font>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                        </div>

                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="checkbox13" style="font-size: 10px !important;">Thank You, Your account has now been loaded with X Credits</label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-7">
                                            <label for="checkbox13" class="font-clr" style="color: #a832a4">REFERENCE# 000023456</label>
                                        </div>
                                        <div class="col-md-3">

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">

                                        </div> <div class="col-md-4">
                                        <label class="font-clr">&nbsp</label>
                                        <div class="btn-group">
                                            <a href="#!" style="background-color: #a832a4!important;" class="btn btn-success btn-size"><font style="font-size: 10px !important;">CLOSE</font>
                                            </a>
                                        </div>
                                    </div>
                                        <div class="col-md-4">

                                        </div>

                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
                <!-- </div>-->
        </div>
            <!-- </div> -->
    </div>
    <!-- END PAGE CONTENT -->
@endsection 
@section('scripts')
<!-- BEGIN VENDOR JS -->
<script src="{{ URL::asset('new_assets/assets/plugins/pace/pace.min.js')}}"  type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/modernizr.custom.js')}}"  type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-ui/jquery-ui.min.js')}}"  type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/popper/umd/popper.min.js')}}"  type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/bootstrap/js/bootstrap.min.js')}}"  type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery/jquery-easy.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-ios-list/jquery.ioslist.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-actual/jquery.actual.min.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/select2/js/select2.full.min.js')}}" type="text/javascript" src=""></script>
<script src="{{ URL::asset('new_assets/assets/plugins/classie/classie.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/switchery/js/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/lib/d3.v3.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/nv.d3.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/utils.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/tooltip.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/interactiveLayer.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/models/axis.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/models/line.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/models/lineWithFocusChart.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/mapplic/js/hammer.min.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/mapplic/js/jquery.mousewheel.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/mapplic/js/mapplic.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/rickshaw/rickshaw.min.js')}}"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-metrojs/MetroJs.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/skycons/skycons.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}"
    type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}"
    type="text/javascript"></script>
<script src="{{ URL::asset('new_assets/assets/plugins/datatables-responsive/js/datatables.responsive.js')}}" type="text/javascript"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{ URL::asset('new_assets/pages/js/pages.js')}}"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ URL::asset('new_assets/assets/js/scripts.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<!-- <script src="assets/js/dashboard.js" type="text/javascript"></script> -->
<script src="{{ URL::asset('new_assets/assets/js/scripts.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function (e) {
        var table = $('#tableTransactions');
        table.dataTable({
            "sDom": "<t><'row'<p i>>",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
            },
            "iDisplayLength": 5
        })

        // var _format = function (d) {
        //     // `d` is the original data object for the row
        //     return '<table class="table table-inline">' +
        //         '<tr>' +
        //         '<td>Learn from real test data <span class="label label-important">ALERT!</span></td>' +
        //         '<td>USD 1000</td>' +
        //         '</tr>' +
        //         '<tr>' +
        //         '<td>PSDs included</td>' +
        //         '<td>USD 3000</td>' +
        //         '</tr>' +
        //         '<tr>' +
        //         '<td>Extra info</td>' +
        //         '<td>USD 2400</td>' +
        //         '</tr>' +
        //         '</table>';
        // }

        // // Add event listener for opening and closing details
        // $('#tableTransactions tbody').on('click', 'tr', function () {
        //     //var row = $(this).parent()
        //     if ($(this).hasClass('shown') && $(this).next().hasClass('row-details')) {
        //         $(this).removeClass('shown');
        //         $(this).next().remove();
        //         return;
        //     }
        //     var tr = $(this).closest('tr');
        //     var row = table.DataTable().row(tr);

        //     $(this).parents('tbody').find('.shown').removeClass('shown');
        //     $(this).parents('tbody').find('.row-details').remove();

        //     row.child(_format(row.data())).show();
        //     tr.addClass('shown');
        //     tr.next().addClass('row-details');
        // });

        //Date Pickers
        $('#daterangepicker').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'MM/DD/YYYY h:mm A'
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
<!-- END PAGE LEVEL JS -->
@endsection 