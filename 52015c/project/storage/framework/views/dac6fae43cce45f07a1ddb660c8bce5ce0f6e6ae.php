<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="<?php echo url('admin/customers'); ?>" class="btn btn-default btn-add"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Customer Details</h3>

                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">

                        <table class="table">
                            <tbody>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer ID#</strong></td>
                                <td><?php echo e($customer->id); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Name:</strong></td>
                                <td><?php echo e($customer->name); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Email:</strong></td>
                                <td><?php echo e($customer->email); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Phone:</strong></td>
                                <td><?php echo e($customer->phone); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Fax:</strong></td>
                                <td><?php echo e($customer->fax); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Address:</strong></td>
                                <td><?php echo e($customer->address); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer City:</strong></td>
                                <td><?php echo e($customer->city); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Zip:</strong></td>
                                <td><?php echo e($customer->zip); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Joined:</strong></td>
                                <td><?php echo e($customer->created_at->diffForHumans()); ?></td>
                            </tr>
                            <tr>
                                <td width="30%"></td>
                                <td><a href="email/<?php echo e($customer->id); ?>" class="btn btn-primary"><i class="fa fa-send"></i> Contact Customer</a>
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