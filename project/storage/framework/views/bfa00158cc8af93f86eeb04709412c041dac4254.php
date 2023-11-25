<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('home.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('home_assets/css/cart.css')); ?>">
    <?php 
        $price=0;
        $items =0;
        foreach($response as $res){
        $price += $res->cost * $res->quantity;
        $items += $res->quantity;

        $user = Auth::user();
        }
     ?>

    <?php 
        $quantities = 0;
        $products = 0;
        // $quantity = 0;
        // $quantity = null;
     ?>
    <?php $__currentLoopData = $response; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php 
            // $quantity += $res->quantity;
            if ($products == 0 && $quantities == 0){
            $products = $res->product;
            $quantities = $res->quantity;
            }else{
            $products = $products.",".$res->product;
            $quantities = $quantities.",".$res->quantity;
            }
         ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php 
        $delivery_fee=$settings[0]->delivery_fee;
     ?>

    <?php 
        $delivery_fee=$settings[0]->delivery_fee;
        $donation_amount=$settings[0]->donation_amount;
     ?>

    <?php 
        $discount = 0;
        if(Session::has('coupon')){
        $discount = App\Coupon::calculateDiscount(Session::get('coupon'), $price);
        }
     ?>

    <?php 
        $grandTotal = number_format((float)($price+$delivery_fee) * 13/100 +
        $price - $discount + $delivery_fee + $donation_amount, 2, '.', '');
     ?>
    <!-- BEGIN INTRO CONTENT -->
    <section class="p-b-65 p-t-100 m-t-50">
        <div class="container">
            <div class="row">
                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
            <?php endif; ?>
            <!-- Starting of add to cart table -->
                <div class="section-padding product-shoppingCart-wrapper wow fadeInUp">
                    <div class="container">
                        <?php if($response->count()): ?>
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <div class="heading-title">
                                        <h3>Your Shopping Cart</h3>
                                    </div>
                                    <?php if(Session::has('message')): ?>
                                        <div class="alert alert-success alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo e(Session::get('message')); ?>

                                        </div>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $response; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                            $product = \App\Product::where('id', $res->product)->first();
                                         ?>
                                        <div class="cart-product-list-wrap">
                                            <ul class="cart-product-list">
                                                <li class="cart-item">
                                                    <div class="cart-product-img hidden-xs">
                                                        <?php if($product['feature_image']): ?>
                                                            <img src="<?php echo e(url('/assets/images/products')); ?>/<?php echo e($product['feature_image']); ?>" class="img-responsive"/>
                                                        <?php else: ?>
                                                            <img src="https://via.placeholder.com/100" class="img-responsive"/>
                                                        <?php endif; ?>

                                                    </div>
                                                    <div class="cart-product-name hidden-xs">
                                                        <?php echo e($product->title); ?>

                                                    </div>
                                                    <div class="cart-product-count hidden-xs">
                                                        <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <form action="<?php echo e(url('/') . '/cart/product/qtydown/' . $res->product); ?>"
                                                              method="GET">
                                                            <?php echo e(csrf_field()); ?>

                                                            <button class="btn btn-default btn-number" type="submit">
                                                                <span class="glyphicon glyphicon-minus"></span>
                                                            </button>
                                                        </form>
                                                    </span>
                                                          <input type="text" name="quant[1]" class="form-control input-number" value="<?php echo e($res->quantity); ?>" min="1" max="10">
                                                   <span class="input-group-btn">
                                                        <form action="<?php echo e(url('/') . '/cart/product/qtyup/' . $res->product); ?>"
                                                              method="GET">
                                                            <?php echo e(csrf_field()); ?>

                                                            <button class="btn btn-default btn-number" type="submit">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </button>
                                                        </form>
                                                    </span>
                                                        </div>
                                                    </div>
                                                    <div class="cart-product-price hidden-xs">
                                                        $<?php echo e(number_format((float)$res->cost, 2, '.', '')); ?>

                                                    <!-- $<?php echo e(number_format((float)$res->cost * $res->quantity, 2, '.', '')); ?> -->
                                                    </div>

                                                    <div class="cart-product-option hidden-xs">
                                                        <form action="<?php echo e(url('/') . '/cartdelete/product/' . $res->product); ?>" method="GET">
                                                            <?php echo e(csrf_field()); ?>

                                                            <button title="Remove This Item" type="submit" style="margin: 5px 0 !important; background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;"><i class="fa fa-times-circle"></i></button>
                                                        </form>
                                                    </div>

                                                    <!--mobile view-->
                                                    <div class="visible-xs">
                                                        <div class="row">
                                                            <div class="col-xs-4">
                                                                <div class="cart-product-img">
                                                                    <?php if($product['feature_image']): ?>
                                                                        <img src="<?php echo e(url('/assets/images/products')); ?>/<?php echo e($product['feature_image']); ?>" class="img-responsive"/>
                                                                    <?php else: ?>
                                                                        <img src="https://via.placeholder.com/100" class="img-responsive"/>
                                                                    <?php endif; ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-xs-8">
                                                                <div class="row">
                                                                    <div class="col-xs-10">
                                                                        <div class="cart-product-name">
                                                                            <a href="<?php echo e(url('product/') . '/' . $res->product . '/' . str_replace(' ', '-', $res->title)); ?>"><?php echo e($res->title); ?></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-2">
                                                                        <div class="cart-product-option">
                                                                            <form action="<?php echo e(url('/') . '/cartdelete/product/' . $res->product); ?>"
                                                                                  method="GET">
                                                                                <?php echo e(csrf_field()); ?>

                                                                                <button title="Remove This Item" type="submit" style="margin: 5px 0 !important;  background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer; overflow: hidden; outline:none;"><i class="fa fa-times-circle"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-xs-6">
                                                                        <div class="cart-product-count">
                                                                            <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <form action="<?php echo e(url('/') . '/cart/product/qtydown/' . $res->product); ?>" method="GET">
                                                                    <?php echo e(csrf_field()); ?>

                                                                    <button class="btn btn-default btn-number"
                                                                            type="submit">
                                                                        <span class="glyphicon glyphicon-minus"></span>
                                                                    </button>
                                                                </form>
                                                            </span>
                                                                 <input type="text" name="quant[1]" class="form-control input-number" value="<?php echo e($res->quantity); ?>" min="1" max="10">
                                                           <span class="input-group-btn">
                                                                <form action="<?php echo e(url('/') . '/cart/product/qtyup/' . $res->product); ?>"
                                                                        method="GET">
                                                                    <?php echo e(csrf_field()); ?>

                                                                    <button class="btn btn-default btn-number" type="submit">
                                                                        <span class="glyphicon glyphicon-plus"></span>
                                                                    </button>
                                                                </form>
                                                            </span>
                                                            </div>
                                                         </div>

                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <div class="cart-product-price">
                                                                            $<?php echo e(number_format((float)$res->cost, 2, '.', '')); ?>

                                                                        <!-- $<?php echo e(number_format((float)$res->cost * $res->quantity, 2, '.', '')); ?> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                </li>
                                            </ul>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="heading-title">
                                        <h3>Order Summary </h3>
                                    </div>
                                    <div class="order-summery">
                                        <div class="row os-item " style="">
                                            <div class="col-xs-8 os-item-title">
                                                Subtotal :
                                            </div>
                                            <div class="col-xs-4 price">
                                                $<?php echo e(number_format((float)$price, 2, '.', '')); ?>

                                            </div>
                                        </div>
                                        <?php if(Session::has('coupon')): ?>
                                            <div class="row os-item">
                                                <div class="col-xs-8 os-item-title">
                                                    Discount :
                                                </div>
                                                <div class="col-xs-4 price">
                                                    -$ <?php echo e(number_format((float)$discount, 2, '.', '')); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="row os-item">
                                            <div class="col-xs-8 os-item-title">
                                                Shipping :
                                            </div>
                                            <div class="col-xs-4 price">
                                                $<?php echo e(number_format((float)$delivery_fee, 2, '.', '')); ?>

                                            </div>
                                        </div>
                                        <div class="row os-item">
                                            <div class="col-xs-8 os-item-title">
                                                Tax (13%) :
                                            </div>
                                            <div class="col-xs-4 price">
                                                $<?php echo e(number_format((float) ($price+$delivery_fee) * 0.13, 2, '.', '')); ?>

                                            </div>
                                        </div>
                                        <div class="row os-item">
                                            <div class="col-xs-8 os-item-title">
                                                <div class="makeittext" data-toggle="popover"
                                                     title="" data-content="Help Us Make A Difference!
Your small micro donation will go towards providing free services and programs for Mental Health.  In addition, this Merchant will also generously match your donation. <br> <br> <a href='<?php echo e(route('home.makeitcount')); ?>' target='_blank' title='test add link'>Click Here </a> to learn more about this program
and the Janeen Foundation" data-original-title="Make It Count">Make it count  <img class="makeitcounticon" src="<?php echo e(url('/assets/img/makeitcounticon.png')); ?>"> :
                                                </div>
                                            </div>
                                            <div class="col-xs-4 price">
                                                $<?php echo e(number_format((float)$donation_amount, 2, '.', '')); ?>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row os-item grand-total-line">
                                            <div class="col-xs-8 os-item-title">
                                                Grand Total :
                                            </div>
                                            <div class="col-xs-4">
                                                <b>$<?php echo e($grandTotal); ?></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <?php
                                                $product_id=Session::get('product_id');
                                                ?>
                                                <?php if(!Auth::guard('profile')->user()): ?>
                                                    <a href="<?php echo e(url('/customers/products/').'/'.$product_id); ?>" class="btn btn-block btn-checkout checkout">Checkout</a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(url('/customers/products/').'/'.$product_id); ?>" class="btn btn-block btn-checkout checkout">Checkout</a>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <hr>
                                        </div>
                                        <?php if(!Session::has('coupon')): ?>
                                            <h5 class="card-title all-caps">Have a Coupon Code?</h5>
                                            <form action="<?php echo e(route('coupon.apply')); ?>" method="POST">
                                                <?php echo e(csrf_field()); ?>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code" required>
                                                </div>
                                                <button type="submit" class="btn apply-btn">Apply</button>
                                            </form>
                                        <?php else: ?>
                                            <h5 class="card-title">Coupon Applied</h5>
                                            <form class="form-inline" action="<?php echo e(route('coupon.remove')); ?>"
                                                  method="POST">
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('delete')); ?>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code" value="<?php echo e(Session::get('coupon')['code']); ?>" readonly>
                                                </div>
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="heading-title">
                                <h3 class="text-center">Your Shopping Cart</h3>
                            </div>

                            <div class="col-md-6 col-md-offset-3">
                                <hr>
                                <div class="ube-card-body">
                                    <div class="text-center" id="emptyCart">Hey! Looks like your cart is empty, Please add some products! <br>
                                        <a href="<?php echo e(route('home.order')); ?>"><i class="fa fa-cart-arrow-down"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <!-- Ending of add to cart table -->
            </div>
        </div>
        </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('home.shop.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.shop.includes.master',['cart_result'=> $response], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>