<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                    <a href="<?php echo url('admin/vendors'); ?>" class="btn btn-default btn-back"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <h3>Vendors Pending</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            <?php if(Session::has('message')): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo e(Session::get('message')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                            <thead>
                            <tr>
                                <th>Vendor Name</th>
                                <th width="10%">Vendor Email</th>
                                <th>Phone</th>
                                <th width="10%">Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($vendor->name); ?></td>
                                    <td><?php echo e($vendor->email); ?></td>
                                    <td><?php echo e($vendor->phone); ?></td>
                                    <td><?php echo e($vendor->address); ?></td>
                                    <td>Pending</td>

                                    <td>

                                        <a href="<?php echo e(url('admin/vendors')); ?>/<?php echo e($vendor->id); ?>" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View Details </a>

                                        <a href="<?php echo e(url('admin/vendors/accept')); ?>/<?php echo e($vendor->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Accept</a>
                                        <a href="<?php echo e(url('admin/vendors/reject')); ?>/<?php echo e($vendor->id); ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Reject</a>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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