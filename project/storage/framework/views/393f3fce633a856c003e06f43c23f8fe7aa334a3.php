<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="<?php echo url('admin/orders'); ?>" class="btn btn-default btn-add"><i
                                    class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Order Details</h3>

                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">

                        <table class="table">
                            <tbody>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Order ID#</strong></td>
                                <td><?php echo e($order->id); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Name:</strong></td>
                                <td><?php echo e($order->customer_name); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Email:</strong></td>
                                <td><?php echo e($order->customer_email); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Phone:</strong></td>
                                <td><?php echo e($order->customer_phone); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Address:</strong></td>
                                <td><?php echo e($order->customer_address); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer City:</strong></td>
                                <td><?php echo e($order->customer_city); ?></td>
                            </tr>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Customer Postal Code:</strong></td>
                                <td><?php echo e($order->customer_zip); ?></td>
                            </tr>
                            <?php if(isset($cus_details->unit_no)): ?>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Unit #:</strong></td>
                                    <td><?php echo e($cus_details->unit_no); ?></td>
                                </tr>
                            <?php endif; ?>
                            
                            <?php if(isset($cus_details->buzz_code)): ?>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Buzz Code:</strong></td>
                                    <td><?php echo e($cus_details->buzz_code); ?></td>
                                </tr>
                            <?php endif; ?>
                            
                            <?php if($order->order_type == 3): ?>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Service Type:</strong></td>
                                    <td>
                                        <?php echo e($order_inquiry->service_type); ?>

                                    </td>
                                </tr>
                                <?php if($order_inquiry->shredding_type): ?>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shredding Type:</strong></td>
                                        <td>
                                            <?php echo e($order_inquiry->shredding_type); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($order_inquiry->packing_container): ?>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Packing Type:</strong></td>
                                        <td>
                                            <?php echo e($order_inquiry->packing_container); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($order_inquiry->quantity): ?>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Quantity:</strong></td>
                                        <td>
                                            <?php echo e($order_inquiry->quantity); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($order_inquiry->additional_info): ?>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Additional
                                                Information:</strong></td>
                                        <td>
                                            <?php echo e($order_inquiry->additional_info); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Start Date:</strong>
                                    </td>
                                    <td>
                                        <?php echo e($order_inquiry->start_date); ?>

                                    </td>
                                </tr>
                                 <?php if($order_inquiry->promo_code): ?>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Promo Code:</strong>
                                    </td>
                                    <td>
                                        <?php echo e($order_inquiry->promo_code); ?>

                                    </td>
                                </tr>
                                <?php endif; ?>
                                
                            <?php else: ?>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Shipping Option:</strong></td>
                                    <td>
                                        <?php if($order->shipping == "pickup"): ?>
                                            Pick Up
                                        <?php else: ?>
                                            Ship To Address
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php if($order->shipping == "pickup"): ?>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Pickup Location:</strong>
                                        </td>
                                        <td><?php echo e($order->pickup_location); ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Name:</strong></td>
                                        <td><?php echo e($order->shipping_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Email:</strong></td>
                                        <td><?php echo e($order->shipping_email); ?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Phone:</strong></td>
                                        <td><?php echo e($order->shipping_phone); ?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Address:</strong>
                                        </td>
                                        <td><?php echo e($order->shipping_address); ?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping City:</strong></td>
                                        <td><?php echo e($order->shipping_city); ?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong>Shipping Postal
                                                Code:</strong>
                                        </td>
                                        <td><?php echo e($order->shipping_zip); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Total Product:</strong></td>
                                    <td><?php echo e(array_sum($order->quantities)); ?></td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Total Cost:</strong></td>
                                    <td><?php echo e($settings[0]->currency_sign); ?><?php echo e($order->pay_amount); ?></td>
                                </tr>
                                <tr>
                                    <td width="30%" style="text-align: right;"><strong>Payment Method:</strong></td>
                                    <td><?php echo e($order->method); ?></td>
                                </tr>
                                <?php if($order->method != "Cash On Delivery"): ?>
                                    <?php if($order->method=="Stripe"): ?>
                                        <tr>
                                            <td width="30%" style="text-align: right;"><strong><?php echo e($order->method); ?> Charge
                                                    ID:</strong></td>
                                            <td><?php echo e($order->charge_id); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td width="30%" style="text-align: right;"><strong><?php echo e($order->method); ?>

                                                Transection
                                                ID:</strong></td>
                                        <td><?php echo e($order->txnid); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>
                            <tr>
                                <td width="30%" style="text-align: right;"><strong>Date:</strong></td>
                                <td><?php echo e($order->booking_date); ?></td>
                            </tr>
                            <?php if($order->order_type != 3): ?>
                            <table class="table">
                                <h4 class="text-center">Products Ordered</h4>
                                <hr>
                                <thead>
                                <tr>
                                    <th class="text-left">ITEM</th>
                                    <th class="text-left">DATE</th>
                                    <th class="text-center">QTY</th>
                                    <th class="text-right">AMOUNT</th>
                                 </tr>
                                </thead>
                                <tbody>
                                 <?php
                                            $getOrderProducts = DB::select("select * from ordered_products where orderid='$order->id'");

                                            if(is_array($getOrderProducts) && count($getOrderProducts) > 0){
                                            foreach ($getOrderProducts as $orderDetails) {
                                            if($orderDetails != null){
                                            $productDetail = DB::select("select * from products where id='$orderDetails->productid'");
                                            ?>
                                            <?php 
                                                $date=date_create($orderDetails->created_at);
                                                $new_date= date_format($date,"m/d/Y");
                                             ?>
                                            <tr>
                                                <td class="v-align-middle text-left"><?php echo e($productDetail[0]->title); ?> : <?php echo e($order->service); ?> Service</td>
                                                <td class="v-align-middle text-left"><?php echo e($new_date); ?></td>
                                                <td class="v-align-middle text-center"><?php echo e($orderDetails->quantity); ?></td>
                                                <td class="v-align-middle text-right">
                                                    <?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format((float)$order->subtotal, 2, '.', '')); ?>

                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            }
                                            }
                                   ?>
                        <!--         <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(\App\Product::where('id',$product->productid)->count() > 0): ?>
                                            <td><?php echo e($product->productid); ?></td>
                                            <td><a target="_blank"
                                                   href="<?php echo e(url('/product')); ?>/<?php echo e($product->productid); ?>/<?php echo e(str_replace(' ','-',strtolower(\App\Product::findOrFail($product->productid)->title))); ?>"><?php echo e(\App\Product::findOrFail($product->productid)->title); ?></a>
                                            </td>
                                            <td><?php echo e($product->quantity); ?></td>
                                            <td><?php echo e($product->size); ?></td>
                                            <td>
                                                <?php if($product->owner == "vendor"): ?>
                                                    <a href="<?php echo e(url('/admin/vendors')); ?>/<?php echo e($product->vendorid); ?>"
                                                       target="_blank"><?php echo e(\App\Vendors::findOrFail($product->vendorid)->shop_name); ?></a>
                                                <?php else: ?>
                                                    Admin
                                                <?php endif; ?>
                                            </td>
                                            <td class="o-<?php echo e($product->status); ?>"><?php echo e(ucfirst($product->status)); ?></td>
                                        <?php else: ?>
                                            <?php 
                                               $product_list=$product->productid;
                                             ?>
                                            <td><?php echo e($product_list->id); ?></td>
                                            <td><?php echo e($product_list->title); ?></td>
                                            <td>
                                            <?php 
                                               $product_list=$product->productid;
                                               $tiers= $product_list->tiers;
                                               $tiers=unserialize($tiers);
                                               foreach ($tiers as $key => $value) {
                                                  echo ucfirst($key)." : ".$value.", ";
                                               }
                                              ?>
                                            </td>
                                            <td>$<?php echo e($product_list->price); ?></td>
                                            <td>
                                                <?php if($product_list->owner == "vendor"): ?>
                                                    <?php if(\App\Vendors::where('id',$product_list->vendorid)->count() > 0): ?>
                                                        <?php echo e(\App\Vendors::findOrFail($product_list->vendorid)->shop_name); ?>

                                                    <?php else: ?>
                                                        <span style="color:red;">Vendor Account Deleted</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    Admin
                                                <?php endif; ?>
                                            </td>
                                            <td class="o-<?php echo e($product->status); ?>"><?php echo e(ucfirst($product->status)); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->

                                </tbody>
                            </table>
                           <?php endif; ?>
                            <tr>
                                <td width="30%"></td>
                                <td><a href="email/<?php echo e($order->id); ?>" class="btn btn-primary"><i class="fa fa-send"></i>
                                        Contact Customer</a>
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