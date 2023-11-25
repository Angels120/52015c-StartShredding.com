<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="<?php echo url('admin/vendors'); ?>" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Vendor Details</h3>

                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">

                        <table class="table">
                            <tbody>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Vendor ID#</strong></td>
                                <td><?php echo e($vendor->id); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Vendors Company Name:</strong></td>
                                <td><?php echo e($vendor->shop_name); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Total Products:</strong></td>
                                <td><strong><?php echo e(\App\Product::where('vendorid',$vendor->id)->count()); ?></strong></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Vendor Name:</strong></td>
                                <td><?php echo e($vendor->name); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Vendor Email:</strong></td>
                                <td><?php echo e($vendor->email); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Vendor Phone:</strong></td>
                                <td><?php echo e($vendor->phone); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Vendor Fax:</strong></td>
                                <td><?php echo e($vendor->fax); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Vendor Address:</strong></td>
                                <td><?php echo e($vendor->address); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Vendor City:</strong></td>
                                <td><?php echo e($vendor->city); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Vendor Zip:</strong></td>
                                <td><?php echo e($vendor->zip); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Joined:</strong></td>
                                <td><?php echo e($vendor->created_at->diffForHumans()); ?></td>
                            </tr>
                            <tr>
                                <td width="30%"></td>
                                <td><a href="email/<?php echo e($vendor->id); ?>" class="btn btn-primary"><i class="fa fa-send"></i> Contact Vendor</a>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.includes.master-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>