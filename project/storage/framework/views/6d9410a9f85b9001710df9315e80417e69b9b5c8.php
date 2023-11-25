<?php $__env->startSection('content'); ?>

<style>
    .suggesstion-box {
        position: absolute;
        z-index: 1;
        width: 90%;
    }

    .suggesstion-box li {
        list-style: none;
        /* background: lavender; */
        background: lavender;
        padding: 4px;
        margin-bottom: 1px;
        overflow-wrap: break-word;
    }

    .suggesstion-box li:hover {
        cursor: pointer;
    }

    .dataTables_filter {
        display: none;
    }

    .chosen-single {
        height: 100px;
    }
</style>

<script src="<?php echo e(URL::asset('assets/map/js/jquery1.11.3.min.js')); ?>"></script>


<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row" id="main">
            <!-- Page Heading -->
            <div class="go-title">
                <h3>Customers</h3>
                <div class="go-line"></div>
            </div>
            <!-- Page Content -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" action="<?php echo e(url('/admin/customers/searchResults')); ?>" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12 customer_left_portion">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input name="search" class="form-control" placeholder="Search" autocomplete="off" type="text" id="search">
                                    <span class="input-group-btn"><label class="btn btn-default search-icon"><i class="fa fa-search"></i></label></span>
                                </div>
                            </div>                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <label for="store">Store:</label> -->
                                    <select class="form-control chzn-select" name="store" id="store">
                                        <option value="" selected>Store</option>
                                        <?php if(!empty($vendors)): ?>
                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ven): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ven->id); ?>" <?php echo e(($ven->id==$store) ? "selected" : ""); ?> ><?php echo e($ven->shop_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <label for="client_type">Status:</label> -->
                                    <select class="form-control chzn-select" name="status" id="status">
                                        <option value="" selected>Status</option>
                                        <option value="1" <?php echo e(($status==1) ? "selected" : ""); ?> >Active</option>
                                        <option value="2" <?php echo e(($status==2) ? "selected" : ""); ?>>Banned</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <label for="client_type">Client Type:</label> -->
                                    <select class="form-control chzn-select" name="client_type" id="client_type">
                                        <option value="" selected>Client Type</option>
                                        <?php if(!empty($client_types)): ?>
                                        <?php $__currentLoopData = $client_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctypes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ctypes->id); ?>" <?php echo e(($ctypes->id==$clientType) ? "selected" : ""); ?> ><?php echo e($ctypes->type); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <label for="zone">Zone:</label> -->
                                    <select class="form-control chzn-select" name="zone" id="zone">
                                        <option value="" selected>Zone</option>
                                        <?php if(!empty($zones)): ?>
                                        <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($zo->id); ?>" <?php echo e(($zo->id==$zone) ? "selected" : ""); ?> ><?php echo e($zo->zone_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" placeholder="City Search" class="form-control" id="city" name="city" <?php if(!empty($city)): ?> value="<?php echo e($city); ?>" <?php else: ?> value="" <?php endif; ?>>
                                    <div id="citySearchBox" class="suggesstion-box"></div>
                                </div>
                            </div>
                            <div class="col-md-9" align="right">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>
                                    Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="panel-body">
                    <div id="response">
                        <?php if(Session::has('message')): ?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo e(Session::get('message')); ?>

                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="row" id="mainTable">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered nowrap" cellspacing="0" id="cusTable" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th width="10%">Customer Email</th>
                                        <th width="10%">City</th>
                                        <th>Phone</th>
                                        <th width="10%">Store</th>
                                        <th width="10%">Client Type</th>
                                        <th width="10%">Zone</th>
                                        <th>Status</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><input type="checkbox" id="check" name="check[]"></th>
                                        <td align="center"><?php echo e($customer->id); ?></td>
                                        <td><?php echo e($customer->name); ?></td>
                                        <td><?php echo e($customer->email); ?></td>
                                        <td><?php echo e($customer->city); ?></td>
                                        <td><?php echo e($customer->phone); ?></td>
                                        <td>
                                            <?php 
                                            $shops = \App\VendorCustomers::where('customer_id', '=', $customer->id)
                                            ->where('status', 1)
                                            ->orderBy('vendor_id')
                                            ->get(['vendor_id']);
                                            $count = $shops->count();
                                             ?>
                                            <?php if($count==1): ?>
                                            <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sho): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a style="text-decoration: none" href="<?php echo e(url('/admin/vendors/show/')); ?>/<?php echo e($sh->vendor_id); ?>"><?php echo e($sho->vendor_id); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a style="text-decoration: none" href="<?php echo e(url('/admin/vendors/show/')); ?>/<?php echo e($sh->vendor_id); ?>"><?php echo e($sh->vendor_id); ?></a>,
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($customer->type); ?></td>
                                        <td><?php echo e($customer->zone_name); ?></td>
                                        <td>
                                            <?php if($customer->status != 0): ?>
                                            Active
                                            <?php else: ?>
                                            Banned
                                            <?php endif; ?>
                                        </td>

                                        <td>

                                            <form method="POST" action="<?php echo action('CustomerController@destroy',['id' => $customer->id]); ?>">
                                                <?php echo e(csrf_field()); ?>

                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="<?php echo e(url('/admin/customers')); ?>/<?php echo e($customer->id); ?>" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View
                                                    Details </a>

                                                <a href="<?php echo e(url('/admin/customers/email')); ?>/<?php echo e($customer->id); ?>" class="btn btn-primary btn-xs"><i class="fa fa-send"></i> Send
                                                    Email</a>

                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </button>
                                            </form>

                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <small>Please, select customers from the above table to assign to a vendor</small>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="store">Vendor:</label>
                                <select class="form-control chzn-select" id="vendor" name="vendor">
                                    <option value="0" selected disabled>Please Select</option>
                                    <?php if(!empty($vendors)): ?>
                                    <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ven): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ven->id); ?>">Store <?php echo e($ven->id); ?> | <?php echo e($ven->shop_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <button style="margin-top: 10%" type="button" onclick="assignCustomers()" class="btn btn-primary">Assign to Vendor</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<script>
    $(function() {
        $(".chzn-select").chosen();
    });

    // AJAX call for Customer autocomplete 
    $(document).ready(function() {
        $("#city").keyup(function() {
            $.ajax({
                type: "GET",
                url: '<?php echo url('/searchAjaxCities'); ?>',
                data: {
                    'keyword': $('#city').val()
                },
                success: function(data) {
                    $("#citySearchBox").show();
                    $("#citySearchBox").html(data);
                }
            });
        });
    });

    function selectCity($val) {
        $("#city").val($val);
        $("#citySearchBox").hide();
    }

    $(document).ready(function() {
        $('#cusTable').DataTable({
            "pageLength": 50,
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "scrollX": true,
            "scrollY": "300px",
        });

        var table = $('#cusTable').DataTable();

        // #myInput is a <input type="text"> element
        $('#search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });

    function assignCustomers() {
        $vendor = $('#vendor').val();

        var values = new Array();
        $.each($("input[name='check[]']:checked"), function() {
            var data = $(this).parents('tr:eq(0)');
            values.push({
                'cus_id': $(data).find('td:eq(0)').text(),
                'name': $(data).find('td:eq(1)').text(),
                'phone': $(data).find('td:eq(4)').text()
            });
        });

        console.log(values);

        if (values.length == 0) {
            swal("Oops...", "Please, select customers to assign!", "error");
        } else if ($vendor == null) {
            swal("Oops...", "Please, select vendor!", "error");
        } else {
            $.ajax({
                type: "GET",
                url: '<?php echo url('/assignCustomersToVendor'); ?>',
                data: {
                    'vendorId': $vendor,
                    'selectedList': values
                },
                success: function(data) {
                    swal("Success", data, "success");
                    window.location.href = "<?php echo e(URL::to('/admin/customers')); ?>"
                }
            });
        }
    }
</script>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.includes.master-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>