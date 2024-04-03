@extends('vendor.includes.master-vendor')

@section('content')

    <link href="{{ URL::asset('assets/map/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/custom.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/bootstrap-4-utilities.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <style>
        .w-100 {
            width: 100% !important;
        }
    </style>
    <script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
    <script src="{{ URL::asset('assets/map/js/jquery.blockUI.js')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="page-title row">
        <h2>Edit Template</h2>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="container row">
        <div class="row main-row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2 left-table">
                <div class="bg-white row">
                    <div class="col-md-12 col-lg-12 col-sm-12">


                        <!-- form starting -->
                        <form action="/vendor/order-template/update" method="POST">
                        {{csrf_field()}}
                            <input name="template_id" type="hidden" value="{{$orderTemplate->id}}" />

                    <div class="address-form-block col-md-12 col-sm-12 col-xs-12 mt-2 ">
                        <h3>Template Details</h3>
                        <br>
                        <br>
                        <br>

                        <div class="row">
                            <div class="col-xs-12 mt-2">
                                <label for="CustomerTemplate" class="control-label col-sm-3">Template Name *</label>
                                <div class="col-sm-4">
                                    <input class="w-100" type="text" name="name" id="name" placeholder="Name" value="{{$orderTemplate->name}}">
                                    @if($errors->has('name'))
                                        <div class="error text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="unit">Account Manager</label>
                                <div class="col-sm-4">
                                    <select class="w-100" type="text" name="manager_id" id="manager_id" placeholder="Manager ID">
                                    <option value="">Select Account Manager</option>
                                       @foreach($accountManagers as $name )
                                         <option value="{{$name->UID}}" <?php if($orderTemplate->manager_id==$name->UID) {?>selected<?php }?>>{{ $name->FULL_NAME }}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>


                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="unit">Job type ID * </label>
                                <div class="col-sm-4">
                                    <select class="w-100" type="text" name="job_type_id" id="job_type_id" placeholder="Job type ID">
                                        <option value="">Select Job type ID</option>

                                        @foreach($job_type as $type )
                                            @php
                                                $job_id=30;
                                                if(isset($orderTemplate->job_type_id))
                                                {
                                                   $job_id=$orderTemplate->job_type_id;
                                                }
                                            @endphp
                                            <option value="{{$type->UID}}" <?php if($type->UID==$job_id) {?>selected<?php }?>>{{ $type->TYPE_NAME }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('job_type_id'))
                                        <div class="error text-danger">{{ $errors->first('job_type_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <br>


                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Repeat * </label>
                                <div class="col-sm-7 mt-2">
                                    <span class="element">
                                        <input type="radio" name="repeat" id="repeat_pattern_1" value="Daily" <?php if($orderTemplate->repeat=='Daily') {echo 'checked="yes"'; }?>> Daily
                                        <input type="radio" name="repeat" id="repeat_pattern_2" value="Weekly" <?php if($orderTemplate->repeat=='Weekly') {echo 'checked="yes"'; }?>> Weekly
                                        <input type="radio" name="repeat" id="repeat_pattern_3" value="Monthly" <?php if($orderTemplate->repeat=='Monthly') {echo 'checked="yes"'; }?>> Monthly
                                        <input type="radio" name="repeat" id="repeat_pattern_4" value="Quarterly" <?php if($orderTemplate->repeat=='Quarterly') {echo 'checked="yes"'; }?>> Qarterly
                                        <input type="radio" name="repeat" id="repeat_pattern_5" value="Semi-Annual" <?php if($orderTemplate->repeat=='Semi-Annual') {echo 'checked="yes"'; }?>> Semi-Annual
                                        <input type="radio" name="repeat" id="repeat_pattern_6" value="Yearly" <?php if($orderTemplate->repeat=='Yearly') {echo 'checked="yes"'; }?>> Yearly
                                        <input type="radio" name="repeat" id="repeat_pattern_7" value="On Call" <?php if($orderTemplate->repeat=='On Call') {echo 'checked="yes"'; }?>> On Call
                                    </span>
                                    <script>
                                        $(document).ready(function () {
                                            $("#repeat_pattern_1").click(function() {
                                                $("#days_apart_div").show();
                                                $("#weeks_apart_div").hide();
                                                $("#months_apart_div").hide();
                                            });
                                            $("#repeat_pattern_2").click(function() {
                                                $("#days_apart_div").hide();
                                                $("#weeks_apart_div").show();
                                                $("#months_apart_div").hide();
                                            });
                                            $("#repeat_pattern_3").click(function() {
                                                $("#days_apart_div").hide();
                                                $("#weeks_apart_div").hide();
                                                $("#months_apart_div").show();

                                            });
                                            $("#repeat_pattern_4").click(function() {
                                                $("#days_apart_div").hide();
                                                $("#weeks_apart_div").hide();
                                                $("#months_apart_div").hide();
                                            });
                                            $("#repeat_pattern_5").click(function() {
                                                $("#days_apart_div").hide();
                                                $("#weeks_apart_div").hide();
                                                $("#months_apart_div").hide();
                                            });
                                            $("#repeat_pattern_6").click(function() {
                                                $("#days_apart_div").hide();
                                                $("#weeks_apart_div").hide();
                                                $("#months_apart_div").hide();
                                            });
                                            $("#repeat_pattern_7").click(function() {
                                                $("#days_apart_div").hide();
                                                $("#weeks_apart_div").hide();
                                                $("#months_apart_div").hide();
                                            });
                                        });
                                    </script>
                                    <div class="aparts" id="days_apart_div" style="display:<?php if($orderTemplate->repeat=='Daily') {echo 'block;'; } else { echo 'none;';}?>"><label>Every</label>
                                        <span class="element">
                                            <input id="days_apart" name="days_apart" type="TEXT" maxlength="3" size="4" value="<?php echo $orderTemplate->days_apart;?>" title="Number of days after which this job should be repeated, only for daily pattern">
                                         <strong>days</strong>
                                        </span>
                                    </div>
                                    <div class="aparts" id="weeks_apart_div" style="display:<?php if($orderTemplate->repeat=='Weekly') {echo 'block;'; } else { echo 'none;';}?>">
                                        <label>Every</label>
                                        <span class="element">
                                            <input id="weeks_apart" name="weeks_apart" type="TEXT" maxlength="3" size="4" value="<?php echo $orderTemplate->weeks_apart;?>" title="Number of weeks before this job is repeated, only for weekly pattern">
                                         <strong>weeks</strong>
                                        </span>
                                    </div>
                                    <div class="aparts" id="months_apart_div" style="display:<?php if($orderTemplate->repeat=='Monthly') {echo 'block;'; } else { echo 'none;';}?>">
                                        <label>Every</label>
                                        <span class="element">
                                            <input id="months_apart" name="months_apart" type="TEXT" maxlength="3" size="4" value="<?php echo $orderTemplate->months_apart;?>" title="Number of monthd to pass for this job to be repeated, only for monhtlhy pattern">
                                            <strong>months</strong>
                                        </span>
                                    </div>
                                    @if($errors->has('repeat'))
                                        <div class="error text-danger">{{ $errors->first('repeat') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <br>


                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Days Allowed * </label>
                                <div class="col-sm-4">
                                    <?php
                                    $days=$orderTemplate->days_allowed;
                                    foreach ($days AS $allowed)
                                        {
                                            $days_allowed[$allowed]=$allowed;
                                        }

                                    ?>
                                    <select name="days_allowed[]" placeholder="Please Select" class="form-control custom-select" multiple id="days_allowed">
                                        <option value="1" <?php if(array_key_exists(1, $days_allowed) && $days_allowed[1]) {?>selected<?php }?> @if(is_array(old('days_allowed')) && in_array(1,old('days_allowed'))) selected @endif>Monday</option>
                                        <option value="2" <?php if(array_key_exists(2, $days_allowed) && $days_allowed[2]) {?>selected<?php }?> @if(is_array(old('days_allowed')) && in_array(2,old('days_allowed'))) selected @endif>Tuesday</option>
                                        <option value="3" <?php if(array_key_exists(3, $days_allowed) && $days_allowed[3]) {?>selected<?php }?> @if(is_array(old('days_allowed')) && in_array(3,old('days_allowed'))) selected @endif>Wednesday</option>
                                        <option value="4" <?php if(array_key_exists(4, $days_allowed) && $days_allowed[4]) {?>selected<?php }?> @if(is_array(old('days_allowed')) && in_array(4,old('days_allowed'))) selected @endif>Thursday</option>
                                        <option value="5" <?php if(array_key_exists(5, $days_allowed) && $days_allowed[5]) {?>selected<?php }?> @if(is_array(old('days_allowed')) && in_array(5,old('days_allowed'))) selected @endif>Friday</option>
                                        <option value="6" <?php if(array_key_exists(6, $days_allowed) && $days_allowed[6]) {?>selected<?php }?> @if(is_array(old('days_allowed')) && in_array(6,old('days_allowed'))) selected @endif>Saturday</option>
                                        <option value="7" <?php if(array_key_exists(7, $days_allowed) && $days_allowed[7]) {?>selected<?php }?> @if(is_array(old('days_allowed')) && in_array(7,old('days_allowed'))) selected @endif>Sunday</option>
                                    </select>
                                    @if($errors->has('days_allowed'))
                                        <div class="error text-danger">{{ $errors->first('days_allowed') }}</div>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <br>


                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="unit">schedule From*</label>
                                <div class="col-sm-4">
                                    <?php 
                                     $schedule_from= date('m-d-Y', strtotime($orderTemplate->schedule_from));   
                                    ?>
                                    <input class="w-100 datepicker" type="text" name="schedule_from" id="schedule_from" value="{{$schedule_from}}" placeholder="mm-dd-yyyy" data-date-format="mm-dd-yyyy">
                                    @if($errors->has('schedule_from'))
                                        <div class="error text-danger">{{ $errors->first('schedule_from') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>

                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="unit">Service Time</label>
                                <div class="col-sm-4">
                                    <input class="w-100" name="avg_service_time" id="avg_service_time" value="{{$orderTemplate->avg_service_time}}">
                                    @if($errors->has('avg_service_time'))
                                        <div class="error text-danger">{{ $errors->first('avg_service_time') }}</div>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <br>
                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Is Active*</label>
                                <div class="col-sm-4">
                                    <select name="is_active" class="form-control" id="is_active">
                                        <option value="1" <?php if($orderTemplate->is_active==1) {echo 'selected'; }?>>Yes</option>
                                        <option value="0" <?php if($orderTemplate->is_active==0) {echo 'selected'; }?>>No</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Special Notes</label>
                                <div class="col-sm-4">
                                    <textarea name="special_notes" rows="4" cols="45" placeholder="Enter Note Here">{{$orderTemplate->special_notes}}</textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Payment Method</label>
                                <div class="col-sm-4">
                                    <select name="payment_method" class="form-control" id="payment_method">
                                        <option>Select Payment Option</option>
                                        <option value="Cheque" <?php if($orderTemplate->payment_method=="Cheque") {echo 'selected'; }?>>Cheque</option>
                                        <option value="Cash" <?php if($orderTemplate->payment_method=="Cash") {echo 'selected'; }?>>Cash</option>
                                        <option value="Credit Card" <?php if($orderTemplate->payment_method=="Credit Card") {echo 'selected'; }?>>Credit Card</option>
                                        <option value="Credits" <?php if($orderTemplate->payment_method=="Credits") {echo 'selected'; }?>>Credits</option>
                                        <option value="Debit" <?php if($orderTemplate->payment_method=="Debit") {echo 'selected'; }?>>Debit</option>
                                        <option value="EFT" <?php if($orderTemplate->payment_method=="EFT") {echo 'selected'; }?>>EFT</option>
                                    </select>
                                    <h6> * Requred fields</h6>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="text-right col-xs-12 mt-2">
                                <div class="actions col-xs-7">
                                    <button type="submit" data-next="step2" id="btnCreateClient" class="btn btn-success btn-next">Update<i class="icon-arrow-right"></i></button>
                                    <a href="/vendor/order-template/{{$orderTemplate->id}}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <!------>


                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
        $("#schedule_from").datepicker(
           { 
            todayBtn: "linked",
            language: "it",
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'mm-dd-yy'
        }  
        );
        $('.fromTimeCalendar').click(function() {
            $("#schedule_from").focus();
        });
        });
   </script>
    <script>
        $(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 50,
                ajax: '/vendor/get-template-ajax',
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'job_type_id',
                        name: 'job_type_id'
                    },
                    {
                        data: 'repeat',
                        name: 'repeat'
                    },
                    {
                        data: 'schedule_from',
                        name: 'schedule_from'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false
                    }
                ]
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
@stop

@section('footer')

@stop