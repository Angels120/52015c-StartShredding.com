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
        .order-id{
            max-width: 150px;
            float: left;
            padding-right: 15px;
        }
        .order-id label{
            margin: 8px 0px;
        }
    </style>
    <script src="<?php echo e(URL::asset('assets/map/js/jquery1.11.3.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/map/js/jquery.blockUI.js')); ?>"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="page-title row">
        <h2><?php echo e($client->first_name." ".$client->last_name); ?></h2>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
                <div class="bg-white row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div id="exTab2" class="col-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="<?php echo e(url('/vendor/customer/'.$client->id)); ?>" data-toggle="tab">Overview</a></li>
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id.'/templates')); ?>">Templates</a></li>
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id.'/orders')); ?>" >Orders</a></li>
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id.'/billing')); ?>" >Billing</a></li>
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id.'/documents')); ?>" >Documents</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active mt-3" id="1">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="top-title">
                                                <h3>Customer Details</h3>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="mt-2 col-md-4">
                                                    <p><strong>Name:</strong></p>
                                                    <p><?php echo e($client->first_name." ".$client->last_name); ?></p>
                                                </div>
                                                <div class="mt-2 col-md-4">
                                                    <p><strong>Phone:</strong></p>
                                                    <p><?php echo e($client->phone); ?></p>
                                                </div>
                                                <div class="mt-2 col-md-4">
                                                    <p><strong>Email:</strong></p>
                                                    <p><?php echo e($client->email); ?></p>
                                                </div>

                                                <div class="mt-2 col-md-4">
                                                    <p><strong>Address:</strong></p>
                                                    <p><?php echo e($client->address); ?></p>
                                                </div>

                                                <div class="mt-2 col-md-4">
                                                    <p><strong>City:</strong></p>
                                                    <p><?php echo e($client->city); ?></p>
                                                </div>

                                                <div class="mt-2 col-md-4">
                                                    <p><strong>State:</strong></p>
                                                    <p><?php echo e($client->province_state); ?></p>
                                                </div>

                                                <div class="mt-2 col-md-12">
                                                    <p><strong>Post Code:</strong></p>
                                                    <p><?php echo e($client->zip); ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane mt-3" id="2">
                                </div>
                                <div class="tab-pane mt-3" id="3">
                                </div>
                                <div class="tab-pane mt-3" id="4">
                                </div>
                                <div class="tab-pane mt-3" id="5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: '<?php echo e(url('vendor/get-template-ajax')); ?>/<?php echo e($client->id); ?>',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'job_type_id', name: 'job_type_id'},
                    {data: 'repeat', name: 'repeat'},
                    {data: 'schedule_from', name: 'schedule_from'},
                    {data: 'action', name: 'action', searchable: false}
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
    <script src="http://cdn.datatables.net/plug-ins/1.10.15/dataRender/datetime.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>