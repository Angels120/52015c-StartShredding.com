<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="<?php echo url('admin/gift-cards/create'); ?>" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Gift Card</a>
                    </div>
                    <h3>Gift Cards</h3>
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
                        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>description</th>
                                <th>Purchase Price</th>
                                <th>Credit Amount</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $giftcards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $giftcard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($giftcard->type != 1 ? 'active' : null); ?>">
                                    <td><?php echo e($giftcard->title); ?></td>
                                    <td><?php echo e($giftcard->description); ?></td>
                                    <td>$ <?php echo e($giftcard->purchase_price); ?></td>
                                    <td>$ <?php echo e($giftcard->credit_amount); ?></td>
                                    <td>
                                        <?php if($giftcard->type == 1): ?>
                                            Gift Card
                                        <?php else: ?>
                                            Give Away
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($giftcard->status == 1): ?>
                                            Active
                                        <?php else: ?>
                                            Inactive
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <form method="POST" action="<?php echo action('GiftCardController@destroy',['id' => $giftcard->id]); ?>">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="<?php echo url('admin/gift-cards'); ?>/<?php echo e($giftcard->id); ?>/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                            <?php if($giftcard->status==1): ?>
                                                <a href="<?php echo url('admin/gift-cards'); ?>/status/<?php echo e($giftcard->id); ?>/0" class="btn btn-warning btn-xs"><i class="fa fa-times"></i> Deactive </a>
                                            <?php else: ?>
                                                <a href="<?php echo url('admin/gift-cards'); ?>/status/<?php echo e($giftcard->id); ?>/1" class="btn btn-primary btn-xs"><i class="fa fa-times"></i> Active </a>
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