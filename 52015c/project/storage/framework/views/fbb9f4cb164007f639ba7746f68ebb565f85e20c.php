<?php $__env->startSection('content'); ?>

<div class="home-wrapper">
    <!-- Starting of Account Dashboard area -->
    <div class="section-padding dashboard-account-wrapper wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('includes.usermenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-9">
                    <div class="dashboard-content">
                        <div id="my-orders-tab">
                            <h1>my orders</h1>
                            
                                
                                    
                                        
                                    
                                    
                                        
                                            
                                            
                                                
                                                
                                                
                                            
                                        
                                    
                                
                            
                            <div class="table-responsive">
                                <table class="table" id="userOrders">
                                    <thead>
                                    <tr class="table-header-row">
                                        <th>Order#</th>
                                        <th>Date</th>
                                        <th>Order Total</th>
                                        <th>Order Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($order->order_number); ?></td>
                                        <td><?php echo e($order->booking_date); ?></td>

                                        <td><?php echo e($settings[0]->currency_sign); ?><?php echo e($order->pay_amount); ?></td>
                                        <td><?php echo e($order->status); ?></td>
                                        <td><a href="<?php echo e(url('user/order/')); ?>/<?php echo e($order->id); ?>">view order</a></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <a href="" class="back-btn">back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ending of Account Dashboard area -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script>
    $('#userOrders').DataTable( {
        "order": []
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.newmaster', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>