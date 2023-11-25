<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">

                    <h3>Withdraws <a href="<?php echo e(url('admin/withdraws/pending')); ?>" class="btn btn-info"><strong>Pending Withdraws <label class="label label-primary"><?php echo e(\App\Withdraw::where('status','pending')->count()); ?></label></strong></a></h3>
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
                                <th>Company Name</th>
                                <th width="10%">Vendors Email</th>
                                <th>Phone</th>
                                <th width="10%">Method</th>
                                <th width="10%">Status</th>
                                <th>Withdraw Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(url('admin/vendors')); ?>/<?php echo e($withdraw->vendorid->id); ?>" target="_blank"><?php echo e($withdraw->vendorid->shop_name); ?></a></td>
                                    <td><?php echo e($withdraw->vendorid->email); ?></td>
                                    <td><?php echo e($withdraw->vendorid->phone); ?></td>
                                    <td><?php echo e($withdraw->method); ?></td>
                                    <td><?php echo e(ucfirst($withdraw->status)); ?></td>
                                    <td><?php echo e($withdraw->created_at); ?></td>
                                    <td>
                                        <a href="withdraws/<?php echo e($withdraw->id); ?>" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View Details </a>
                                        <?php if($withdraw->status == "pending"): ?>
                                        <a href="withdraws/accept/<?php echo e($withdraw->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-check-circle"></i> Accept</a>

                                        <a href="withdraws/reject/<?php echo e($withdraw->id); ?>" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Reject</a>
                                        <?php endif; ?>
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