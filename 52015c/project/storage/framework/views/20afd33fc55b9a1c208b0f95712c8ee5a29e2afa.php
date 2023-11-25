<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="<?php echo url('vendor/products/create'); ?>" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Product</a>
                    </div>
                    <h3>Products</h3>
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
                                <th>Product Title</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->id); ?></td>
                                <td><?php echo e($product->title); ?></td>
                                <td><?php echo e($settings[0]->currency_sign); ?><?php echo e($product->price); ?></td>
                                <td>
                                    <?php echo e(\App\Category::where('id',$product->category[0])->first()->name); ?><br>
                                    <?php if($product->category[1] != ""): ?>
                                    <?php echo e(\App\Category::where('id',$product->category[1])->first()->name); ?><br>
                                    <?php endif; ?>
                                    <?php if($product->category[2] != ""): ?>
                                        <?php echo e(\App\Category::where('id',$product->category[2])->first()->name); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($product->status == 1): ?>
                                        Active
                                    <?php elseif($product->status == 2): ?>
                                        Pending
                                    <?php else: ?>
                                        Inactive
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="POST" action="<?php echo action('VendorProductsController@destroy',['id' => $product->id]); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="<?php echo url('vendor/products'); ?>/<?php echo e($product->id); ?>/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                        <?php if($product->status==1): ?>
                                            <a href="<?php echo url('vendor/products'); ?>/status/<?php echo e($product->id); ?>/0" class="btn btn-warning btn-xs"><i class="fa fa-times"></i> Deactive </a>
                                        <?php elseif($product->status==0): ?>
                                            <a href="<?php echo url('vendor/products'); ?>/status/<?php echo e($product->id); ?>/1" class="btn btn-primary btn-xs"><i class="fa fa-times"></i> Active </a>
                                        <?php else: ?>
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
<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>