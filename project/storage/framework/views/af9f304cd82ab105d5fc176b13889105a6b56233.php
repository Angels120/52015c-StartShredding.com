<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="<?php echo url('admin/coupons/create'); ?>" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Coupon</a>
                    </div>
                    <h3>Coupons</h3>
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
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th width="10%">ID#</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Expiry Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($coupon->id); ?></td>
                                <td><?php echo e($coupon->code); ?></td>
                                <td><?php echo e(ucwords($coupon->type)); ?></td>
                                <td>
                                    <?php echo e($coupon->type === 'percent' ? $coupon->value . " %" : "$ " . $coupon->value); ?>

                                </td>
                                <td>
                                    <?php if($coupon->status == 1): ?>
                                        Active
                                    <?php else: ?>
                                        Inactive
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($coupon->expiry_date); ?>

                                </td>
                                <td>
                                    <form method="POST" action="<?php echo action('CouponController@destroy',['id' => $coupon->id]); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="<?php echo url('admin/coupons'); ?>/<?php echo e($coupon->id); ?>/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                        <?php if($coupon->status==1): ?>
                                            <a href="<?php echo url('admin/coupons'); ?>/status/<?php echo e($coupon->id); ?>/0" class="btn btn-warning btn-xs"><i class="fa fa-times"></i> Deactive </a>
                                        <?php else: ?>
                                            <a href="<?php echo url('admin/coupons'); ?>/status/<?php echo e($coupon->id); ?>/1" class="btn btn-primary btn-xs"><i class="fa fa-times"></i> Active </a>
                                        <?php endif; ?>
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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.includes.master-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>