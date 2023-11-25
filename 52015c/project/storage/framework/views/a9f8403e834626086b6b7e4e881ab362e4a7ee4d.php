<!-- BEGIN HEADER -->
<link rel="stylesheet" href="<?php echo e(URL::asset('home_assets/css/product.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::asset('home_assets/css/comman.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::asset('home_assets/css/logo.css')); ?>">
<script src="https://code.jquery.com/jquery-1.12.1.min.js" name="jquery"></script>
<?php
$price = 0;
$items = 0;
foreach ($cart_result as $res) {
    $price += $res->cost * $res->quantity;
    $items += $res->quantity;
}
$discount = 0;
if (Session::has('coupon')) {
    $discount = App\Coupon::calculateDiscount(Session::get('coupon'), $price);
}
$setting = DB::select('select * from settings where id=1');
$delivery_fee = $setting[0]->delivery_fee;
$donation_amount = $setting[0]->donation_amount;
?>
<nav class="header md-header light-solid " data-pages="header">
    <div class="container relative col-md-12">
        <div>
            <div class="header-inner">
                <div class="col-md-2">
                    <div class="header-inner">
                        <a href="<?php echo e(url('/home')); ?>" > <img src="<?php echo e(url('home_assets/images/logo.png')); ?>" width="152" height="30"
                                                          data-src-retina="<?php echo e(url('home_assets/images/logo.png')); ?>" class="logo" alt="logo"></a>
                        <div class="visible-sm-inline visible-xs-inline menu-toggler pull-right p-l-10"
                             data-pages="header-toggle" data-pages-element="#header">
                            <div class="one"></div>
                            <div class="two"></div>
                            <div class="three"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-content clearfix" data-pages-direction="slideRight" id="header">

            <div class="col-md-7">
                <div class="header-inner">
                    <div class="pull-right">
                        <a href="#"
                           class="text-black link padding-10 visible-xs-inline visible-sm-inline pull-right m-t-10 m-b-10 m-r-10"
                           data-pages="header-toggle" data-pages-element="#header">
                            <i class=" pg-close_line"></i>
                        </a>
                    </div>

                    <ul class="menu">
                        <li>
                            <a href="<?php echo e(url('/home')); ?>" class="active">Home </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/home/customers')); ?>">Just Shred It</a>
                        </li>
                        <li>
                            <a href="portfolio.html">Best Prices </a>
                        </li>
                        <li>
                            <a href="contact.html">Drop Off</a>
                        </li>
                        <li>
                            <a href="contact.html">About Us</a>
                        </li>
                        <li class="non-link">
                            <a>(416) 255 1500</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cont top-cart">
                    <?php if(Auth::guard('profile')->guest()): ?>
                        <span><a style="color: #1d1c80; font-weight: bold" href="<?php echo e(route('home.register')); ?>"
                                 target="_blank">SIGN UP </a> | <a style="color: #1d1c80; font-weight: bold"
                                                                   href="<?php echo e(route('home.user')); ?>">LOGIN</a> | </span>
                    <?php else: ?>
                        <a style="color: #1d1c80; font-weight: bold" href="<?php echo e(route('home.logout')); ?>"><span class="">LOGOUT</span></a>
                        |
                        <a style="color: #1d1c80; font-weight: bold;text-transform:uppercase;"
                           href="<?php echo e(route('home.user-dashboard')); ?>">
                            <span class="title">My Account  $<?php echo e(number_format((float)Auth::guard('profile')->user()->balance, 2, '.', '')); ?></span>
                        </a> |
                    <?php endif; ?>
                    <form id="logout-form" action="<?php echo e(route('home.logout')); ?>" method="POST"
                          style="display: none;"><?php echo e(csrf_field()); ?></form>
                    <?php if(!Auth::guard('profile')->guest()): ?>











                    <?php endif; ?>
                    <div class="dropdown" style="display: inline-block !important;">
                                    <span class="dropdnItem">
                                        <a class="tongle" style="color: #1d1c80; font-weight: bold">
                                            <?php echo e($items); ?> ITEMS |
                                            <?php if($price !== 0): ?>
                                                $<?php echo e(number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '')); ?>

                                            <?php else: ?>
                                                $0.00
                                            <?php endif; ?>
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </span>
                        <?php
                        $product_id = Session::get('product_id');
                        ?>
                        <div class="dropdown-content cart-content<?=(!Auth::guard('profile')->guest())?'-profile':''?>" style="float: right;">
                            <?php if($product_id): ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a class="btn btn-primary"
                                           href="<?php echo e(url('/home/customers/products/').'/'.$product_id); ?>"
                                           style="width: 100%;">CHECK OUT</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-primary" href="<?php echo e(url('/home/shop-cart')); ?>"
                                           style="width: 100%;">GO TO CART</a>
                                    </div>
                                </div>
                                <hr>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="cartProductTable" class="table table-striped"
                                           style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-left">Rate</th>
                                            <th class="text-center">Total</th>
                                            <th style="width:5%"></th>
                                        </tr>
                                        </thead>

                                        <tbody id="cartproductList">
                                        <?php if($cart_result->count() == 0): ?>
                                            <tr>
                                                <td colspan="4">Please add some products first</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php $__currentLoopData = $cart_result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e($res->title); ?>

                                                    </td>
                                                    <td class="text-center"><?php echo e($res->quantity); ?></td>
                                                    <td class="text-left">
                                                        $<?php echo e(number_format((float)$res->cost, 2, '.', '')); ?></td>
                                                    <td class="text-center">
                                                        $<?php echo e(number_format((float)$res->cost * $res->quantity, 2, '.', '')); ?></td>
                                                    <td class="text-center">
                                                        <form action="<?php echo e(url('/home/cartdelete/product/') . '/' . $res->product); ?>"
                                                              method="GET">
                                                            <?php echo e(csrf_field()); ?>

                                                            <button class="fa fa-remove"
                                                                    title="Remove This Item"
                                                                    type="submit"
                                                                    style="margin-top:-5px;"></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
                                        <tbody id="cartSummary"
                                               class="<?php echo e($cart_result->count() == 0 ? 'hidden' : ''); ?>">
                                        <tr>
                                            <td colspan="5">
                                                <table id="totalTable" style="width: 100%;">
                                                    <tr>
                                                        <td>
                                                            <span style='float:right'>Subtotal:</span>
                                                        </td>
                                                        <td class="text-right" id="cartSummarySubtotal">
                                                            $<?php echo e(number_format((float)$price, 2, '.', '')); ?>

                                                        </td>
                                                    </tr>
                                                    <?php if(Session::has('coupon')): ?>
                                                        <tr>
                                                            <td>
                                                                <span style="float:right">Discount:</span>
                                                            </td>
                                                            <td class="text-right" id="cartSummaryDiscount">
                                                                -$<?php echo e(number_format((float)$discount, 2, '.', '')); ?>

                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <tr>
                                                        <td>
                                                            <span style='float:right'>Delivery:</span>
                                                        </td>
                                                        <td class="text-right" id="cartSummaryDelivery">
                                                            $<?php echo e(number_format((float) $delivery_fee, 2, '.', '')); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span style='float:right'>Tax (13%):</span>
                                                        </td>
                                                        <td class="text-right" id="cartSummaryTax">
                                                            $<?php echo e(number_format((float) ($price+$delivery_fee) * 13/100, 2, '.', '')); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                                        <span style='float:right'
                                                                              class="capital popovers"
                                                                              data-toggle="popover" title=""
                                                                              data-content="Help Us Make A Difference!
                                                                            Your small micro donation will go towards providing free services and programs for Mental Health.
                                                                            In addition, this Merchant will also generously match your donation. <br> <br> <a href='<?php echo e(route('home.makeitcount')); ?>' target='_blank' title='test add link'>Click Here </a> to learn more about this program
                                                                            and the Janeen Foundation"
                                                                              data-original-title="Make It Count">Make it count <img
                                                                                    class='makeitcounticon'
                                                                                    src='<?php echo e(url('assets/img/makeitcounticon.png')); ?>'/></span>
                                                        </td>
                                                        <td class="text-right" id="cartSummaryMakeItCount">
                                                            $<?php echo e(number_format((float) $donation_amount, 2, '.', '')); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="line">
                                                                        <span style='float:right'><b>Grand
                                                                                Total:</b></span>
                                                        </td>
                                                        <td class="line text-right"
                                                            id="cartSummaryGrandTotal">
                                                            <b>$<?php echo e(number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '')); ?></b>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
<script>
    function clickHere() {
        $.notify("I'm to the right of this box", "success", {
            position: "bottom right",
            elementPosition: 'bottom right',
            globalPosition: 'bottom right',
        });
    }

    var delivery_fee = "<?php echo e($delivery_fee); ?>";
    var delivery_fee = "<?php echo e($delivery_fee); ?>";
    var donation_amount = "<?php echo e($donation_amount=$setting[0]->donation_amount); ?>";
    var discount_type = "<?php echo e(Session::has('coupon') ? Session::get('coupon')->type : null); ?>";
    var discount_value = "<?php echo e(Session::has('coupon') ? Session::get('coupon')->value : 0); ?>";
</script>