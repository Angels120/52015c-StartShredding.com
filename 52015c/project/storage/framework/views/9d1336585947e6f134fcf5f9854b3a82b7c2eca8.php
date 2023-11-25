<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="<?php echo url('admin/coupons'); ?>" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php if($id === 'new'): ?>
                    <h3>Add Coupon</h3>
                    <?php else: ?>
                    <h3>Edit Coupon</h3>
                    <?php endif; ?>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        <?php if($id === 'new'): ?>
                        <form method="POST" action="<?php echo action('CouponController@store'); ?>" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <?php else: ?>
                        <form method="POST" action="<?php echo action('CouponController@update',['id' => $id]); ?>" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <?php endif; ?>

                            <?php echo e(csrf_field()); ?>


                            <?php if($id !== 'new'): ?>
                            <input type="hidden" name="_method" value="PATCH">
                            <?php endif; ?>

                            <input id="status" class="form-control col-md-7 col-xs-12" name="status" placeholder="Coupon Expiry Date" 
                            <?php if($id !== 'new'): ?>
                            value = "<?php echo e($coupon->status); ?>"
                            <?php else: ?>
                            value = "1"
                            <?php endif; ?>
                            required="required" type="hidden">

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Code<span class="required">*</span></label>
                                <div class="col-md-4 col-sm-4 col-xs-8">
                                    <input id="code" class="form-control col-md-4 col-xs-8" name="code" placeholder="Coupon Code" 
                                    <?php if($id !== 'new'): ?>
                                    value = "<?php echo e($coupon->code); ?>"
                                    <?php endif; ?>
                                    required="required" type="text"
                                    onkeypress="return event.charCode == 13  || event.charCode == 8 || event.charCode == 46 || event.target.value.length < 6">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-4" style="padding-left: 0px">
                                    <button id="auto_code" class="btn btn-primary">Generate Random Code</button>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="type" id="type" required>
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type); ?>"
                                            <?php if($id !== 'new' && $type == $coupon->type): ?>
                                            selected
                                            <?php endif; ?>
                                            ><?php echo e(ucwords($type)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value">Value<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="value" class="form-control col-md-7 col-xs-12" name="value" placeholder="Coupon Value" 
                                    <?php if($id !== 'new'): ?>
                                    value = "<?php echo e($coupon->value); ?>"
                                    <?php endif; ?>
                                    required="required" type="number" step="0.01" min="0" 
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  
     event.charCode == 46  || event.charCode == 0">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expiry_date">Expiry Date<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="expiry_date" class="form-control col-md-7 col-xs-12" name="expiry_date" placeholder="Coupon Expiry Date" 
                                    <?php if($id !== 'new'): ?>
                                    value = "<?php echo e($coupon->expiry_date); ?>"
                                    <?php endif; ?>
                                    type="text">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <?php if($id === 'new'): ?>
                                    <button id="add_coupon" type="submit" class="btn btn-success btn-block">Add New Coupon</button>
                                    <?php else: ?>
                                    <button id="update_coupon" type="submit" class="btn btn-success btn-block">Update Coupon</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
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
    <script>
        document.getElementById("auto_code").addEventListener("click", function(event){
            event.preventDefault();
            var length = 6;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            document.getElementById("code").value = result;
        });

        $( function() {
            $("#expiry_date").datepicker({dateFormat: 'yy-mm-dd'});
        } );
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.includes.master-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>