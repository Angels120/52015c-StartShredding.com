<?php $__env->startSection('content'); ?>

    <link href="<?php echo e(URL::asset('assets/map/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/map/css/custom.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/map/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/map/css/bootstrap-4-utilities.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <style>
        .w-100 {
            width: 100% !important;
        }
    </style>
    <script src="<?php echo e(URL::asset('assets/map/js/jquery1.11.3.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/map/js/jquery.blockUI.js')); ?>"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="page-title row">
        <h2>Create Template</h2>
    </div>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('error')); ?>

        </div>
    <?php endif; ?>

    <div class="container row">
        <div class="row main-row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2 left-table">
                <div class="bg-white row">
                    <div class="col-md-12 col-lg-12 col-sm-12">


                        <!-- form starting -->
                        <form action="/vendor/order-template" method="POST">
                        <?php echo e(csrf_field()); ?>

                            <input name="client_id" type="hidden" value="<?php echo e($id); ?>" />
                            <input name="vendor_id" type="hidden" value="<?php echo e($vendor_id); ?>" />

                    <div class="address-form-block col-md-12 col-sm-12 col-xs-12 mt-2 ">
                        <h3>Template Details</h3>
                        <br>
                        <br>
                        <br>

                        <div class="row">
                            <div class="col-xs-12 mt-2">
                                <label for="CustomerTemplate" class="control-label col-sm-3">Template Name *</label>
                                <div class="col-sm-4">
                                    <input class="w-100" type="text" name="name" id="name" placeholder="Name" style="padding-left: 5px;" value="<?php echo e(old('name')); ?>">
                                    <?php if($errors->has('name')): ?>
                                        <div class="error text-danger"><?php echo e($errors->first('name')); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="unit">Account Manager</label>
                                <div class="col-sm-4">
                                    <select class="w-100" type="text" name="manager_id" id="manager_id" placeholder="Manager ID">
                                        <option value="">Select Account Manager</option>
                                        <?php $__currentLoopData = $accountManagers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($name->UID); ?>" <?php if(($name->UID==old('manager_id'))): ?> selected <?php endif; ?>><?php echo e($name->FULL_NAME); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>


                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="unit">Order Type * </label>
                                <div class="col-sm-4">
                                    <select class="w-100" type="text" name="job_type_id" id="job_type_id" placeholder="Job type ID">
                                        <option value="">Select Order Type</option>

                                        <?php $__currentLoopData = $job_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                                $job_id=30;
                                                if(isset($orderTemplate->job_type_id))
                                                {
                                                   $job_id=$orderTemplate->job_type_id;
                                                }
                                             ?>
                                            <option value="<?php echo e($type->UID); ?>" <?php if($type->UID==30) {?>selected<?php }?><?php if(($type->UID==old('job_type_id'))): ?> selected <?php endif; ?>><?php echo e($type->TYPE_NAME); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>


                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Repeat * </label>
                                <div class="col-sm-7">
                                    <span class="element">
                                        <input type="radio" name="repeat" id="repeat_pattern_1" value="Daily" <?php if(('Daily'==old('repeat'))): ?> checked <?php endif; ?>>&nbsp;Daily&nbsp;
                                        <input type="radio" name="repeat" id="repeat_pattern_2" value="Weekly" <?php if(('Weekly'==old('repeat'))): ?> checked <?php endif; ?>>&nbsp;Weekly&nbsp;
                                        <input type="radio" name="repeat" id="repeat_pattern_3" value="Monthly" <?php if(('Monthly'==old('repeat'))): ?> checked <?php endif; ?>>&nbsp;Monthly&nbsp;
                                        <input type="radio" name="repeat" id="repeat_pattern_4" value="Quarterly" <?php if(('Quarterly'==old('repeat'))): ?> checked <?php endif; ?>>&nbsp;Quarterly&nbsp;
                                        <input type="radio" name="repeat" id="repeat_pattern_5" value="Semi-Annual" <?php if(('Semi-Annual'==old('repeat'))): ?> checked <?php endif; ?>>&nbsp;Semi-Annual&nbsp;
                                        <input type="radio" name="repeat" id="repeat_pattern_6" value="Yearly" <?php if(('Yearly'==old('repeat'))): ?> checked <?php endif; ?>>&nbsp;Yearly&nbsp;
                                        <input type="radio" name="repeat" id="repeat_pattern_7" value="On-Call" checked="checked">&nbsp;On Call
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
                                    <div class="aparts" id="days_apart_div" style="display: none;"><label>Every</label>
                                        <span class="element">
                                            <input id="days_apart" name="days_apart" type="TEXT" maxlength="3" size="4" value="1" title="Number of days after which this job should be repeated, only for daily pattern">
                                         <strong>days</strong>
                                        </span>
                                    </div>
                                    <div class="aparts" id="weeks_apart_div" style="display: none;">
                                        <label>Every</label>
                                        <span class="element">
                                            <input id="weeks_apart" name="weeks_apart" type="TEXT" maxlength="3" size="4" value="1" title="Number of weeks before this job is repeated, only for weekly pattern">
                                         <strong>weeks</strong>
                                        </span>
                                    </div>
                                    <div class="aparts" id="months_apart_div" style="display: none;">
                                        <label>Every</label>
                                        <span class="element">
                                            <input id="months_apart" name="months_apart" type="TEXT" maxlength="3" size="4" value="1" title="Number of monthd to pass for this job to be repeated, only for monhtlhy pattern">
                                            <strong>months</strong>
                                        </span>
                                    </div>
                                    <?php if($errors->has('repeat')): ?>
                                        <div class="error text-danger"><?php echo e($errors->first('repeat')); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <br>
                            <br>


                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Days Allowed * </label>
                                <div class="col-sm-4">
                                    <select name="days_allowed[]" placeholder="Please Select" class="form-control custom-select" multiple
                                            id="days_allowed">
                                        <option value="1" <?php if(is_array(old('days_allowed')) && in_array(1,old('days_allowed'))): ?> selected <?php endif; ?>>Monday</option>
                                        <option value="2" <?php if(is_array(old('days_allowed')) && in_array(2,old('days_allowed'))): ?> selected <?php endif; ?>>Tuesday</option>
                                        <option value="3" <?php if(is_array(old('days_allowed')) && in_array(3,old('days_allowed'))): ?> selected <?php endif; ?>>Wednesday</option>
                                        <option value="4" <?php if(is_array(old('days_allowed')) && in_array(4,old('days_allowed'))): ?> selected <?php endif; ?>>Thursday</option>
                                        <option value="5" <?php if(is_array(old('days_allowed')) && in_array(5,old('days_allowed'))): ?> selected <?php endif; ?>>Friday</option>
                                        <option value="6" <?php if(is_array(old('days_allowed')) && in_array(6,old('days_allowed'))): ?> selected <?php endif; ?>>Saturday</option>
                                        <option value="7" <?php if(is_array(old('days_allowed')) && in_array(7,old('days_allowed'))): ?> selected <?php endif; ?>>Sunday</option>
                                    </select>
                                    <?php if($errors->has('days_allowed')): ?>
                                        <div class="error text-danger"><?php echo e($errors->first('days_allowed')); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <br>
                            <br>

                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="unit">Schedule From *</label>
                                <div class="col-sm-4">
                                    <input class="w-100 datepicker" type="text" name="schedule_from" id="schedule_from" value="<?php echo e(old('schedule_from')); ?>" placeholder="mm-dd-yyyy" data-date-format="mm-dd-yyyy">
                                    <?php if($errors->has('schedule_from')): ?>
                                        <div class="error text-danger"><?php echo e($errors->first('schedule_from')); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>

                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="unit">Service Time (mins)</label>
                                <div class="col-sm-4">
                                    <input class="w-100" name="avg_service_time" type="text" id="avg_service_time" value="10" style="padding-left: 5px;width: 60px !important;" >&nbsp;Minutes
                                    <?php if($errors->has('avg_service_time')): ?>
                                        <div class="error text-danger"><?php echo e($errors->first('avg_service_time')); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <br>
                            <br>
                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Is Active*</label>
                                <div class="col-sm-4">
                                    <select name="is_active" class="form-control" id="is_active">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Special Notes</label>
                                <div class="col-sm-4">
                                    <textarea name="special_notes" rows="4" cols="45" placeholder="Enter Note Here"><?php echo e(old('special_notes')); ?></textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 mt-2">
                                <label class="control-label col-sm-3" for="province">Payment Method</label>
                                <div class="col-sm-4">
                                    <select name="payment_method" class="form-control" id="payment_method">
                                        <option value="Credit Card" selected="selected">Credit Card</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Credits">Credits</option>
                                        <option value="Debit">Debit</option>
                                        <option value="EFT">EFT</option>
                                    </select>
                                    <h6> * Requred fields</h6>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="text-right col-xs-12 mt-2">
                                <div class="actions col-xs-7">
                                    <button type="submit" data-next="step2" id="btnCreateClient" class="btn btn-success btn-next">Create<i class="icon-arrow-right"></i></button>
                                    <a href="/vendor/customer/<?php echo e($id); ?>/templates/" class="btn btn-danger">Cancel</a>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>