<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(URL::asset('assets/map/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/map/css/custom.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/map/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/map/css/bootstrap-4-utilities.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"></script>

    <style>
        .w-100 {
            width: 100% !important;
        }

        .order-id {
            max-width: 150px;
            padding-right: 15px;
        }

        .order-id label {
            margin: 8px 0px;
        }

        div.dt-buttons {
            float: unset;
            margin: 48px 14px 0 0;
        }

        .buttons-select-all, .buttons-select-none {
            text-transform: capitalize;
        }

        .btn-warning {
            color: #fff!important;
            background-color: #f0ad4e!important;
            border-color: #eea236!important;
            background-image: unset!important;
        }
        .btn-info {
            color: #fff!important;
            background-color: #5bc0de!important;
            border-color: #46b8da!important;
            background-image: unset!important;
        }
        .form-inline select.form-control {
         min-width: 100%!important;
      }
      .custom-calendar {
    margin-top: unset;
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
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id)); ?>">Overview</a></li>
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id.'/templates')); ?>">Templates</a></li>
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id.'/orders')); ?>">Orders</a></li>
                                <li class="active"><a href="<?php echo e(url('/vendor/customer/'.$client->id.'/billing')); ?>">Billing</a></li>
                                <li><a href="<?php echo e(url('/vendor/customer/'.$client->id.'/documents')); ?>">Documents</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane  mt-3" id="1"></div>
                                <div class="tab-pane mt-3" id="2"></div>
                                <div class="tab-pane mt-3" id="3"></div>
                                <div class="tab-pane active mt-3" id="4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="top-title">
                                                <h3>Credit Card</h3>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <form action="<?php echo e(url('/vendor/customer/'.$client->id.'/addBilling')); ?>" method="POST" class="" id="form-billing" role="form">
                                                <?php echo e(csrf_field()); ?>

                                                <div class="clearfix"></div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default required">
                                                            <label>Card holder's Name</label>
                                                            <input class="form-control" type="text"
                                                                    name="cardholder_name"
                                                                    id="cardholder_name" value="<?php echo e($user->cardholder_name); ?>"
                                                                    placeholder="Name on card"
                                                                    required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default required">
                                                            <label>Card Number</label>
                                                            <input class="form-control card-no" type="text" name="cardnumber"
                                                                    id="cr-no" value="<?php echo e($user->cardnumber); ?>"
                                                                    placeholder="Card Number" minlength="16" maxlength="19" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-default required">
                                                            <label>Expiry Date</label>
                                                            <input class="form-control" type="text"
                                                                    name="expirydate" value="<?php echo e($user->expirydate); ?>"
                                                                    id="expiry_date" placeholder="01/12" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-default required">
                                                            <label>CVV</label>
                                                            <input class="form-control" type="number"
                                                                    name="cvv" value="<?php echo e($user->cvv); ?>"
                                                                    id="cvv" maxlength="3" minlength="3" placeholder="000" required>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary btn-cons m-t-2" type="submit">
                                                            Save Changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane mt-3" id="5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        
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