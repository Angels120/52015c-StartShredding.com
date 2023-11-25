<?php $__env->startSection('title','Gift Cards'); ?>



<?php $__env->startSection('content'); ?>
<!-- START PAGE CONTENT -->
<div class="content ">
    <!-- START JUMBOTRON -->
    
<!-- END JUMBOTRON -->
<!-- START CONTAINER FLUID -->
<div class=" container-fluid  p-b-50 m-t-40">
    <div class="row">
        <div class="col-md-8">
            <!-- START card -->
            <div class="card card-borderless">
                <ul class="nav nav-tabs nav-tabs-simple d-none d-md-flex d-lg-flex d-xl-flex" role="tablist"
                    data-init-reponsive-tabs="dropdownfx">
                    <li class="nav-item">
                        <a class="active show" data-toggle="tab" role="tab" data-target="#buygiftcard" href="#"
                            aria-selected="true">Buy Gift Card</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab" data-target="#redeemgiftcard" class=""
                            aria-selected="false">Redeem Gift Card</a>
                    </li>
                    <!-- newly added redeemed gift card  -->
                    <li class="nav-item">
                        <a href="#" data-toggle="tab" role="tab" data-target="#redeemedgiftcard" class=""
                            aria-selected="false">Redeemed Gift Card</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <?php if(Session::has('message')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo e(Session::get('message')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(Session::has('error')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo e(Session::get('error')); ?>

                    </div>
                    <?php endif; ?>

                    <div class="tab-pane active show" id="buygiftcard">
                        <div class="row column-seperation">
                            <div class="col-sm-9">
                                <div class="card-deck">
                                    <?php $__currentLoopData = $giftcards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $giftcard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($giftcard->type == 1): ?>
                                    <form method="POST"
                                        action="<?php echo action('BuyGiftCardController@buy', ['id' => $giftcard->id]); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="buy-gift">
                                            <ul class="gift-card">
                                                <li class="buy-gift-only">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- background gift image goes here  -->
                                                            <div class="giftcard-img">
                                                                <img src="<?php echo e(url('assets/img/gift-cards/' . $giftcard->image)); ?>"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <!-- git card details goes here  -->
                                                            <div class="text-main">
                                                                <h3><?php echo e($giftcard->title); ?> |
                                                                    $<?php echo e($giftcard->credit_amount); ?></h3>

                                                                <ul>
                                                                    <li>Expiry Date: <?php echo e($giftcard->expiry_date); ?></li>
                                                                    <li class="last-child">
                                                                        <button id="buygiftcard" type="submit"
                                                                            class="btn btn-brown">buy</button>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="line"></div>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    </form>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <!-- newly added coustom html  -->

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="redeemgiftcard">
                        <div class="row column-seperation">
                            <div class="col-sm-9">
                                <div class="card-deck">
                                    <?php $__currentLoopData = $boughtgiftcards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boughtgiftcard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <form method="POST"
                                        action="<?php echo action('BuyGiftCardController@redeem', ['id' => $boughtgiftcard->id]); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="buy-gift">
                                            <ul class="gift-card">
                                                <li class="buy-gift-only">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="giftcard-redeem">
                                                                <div class="giftcard-img">
                                                                    <img src="<?php echo e(url('assets/img/gift-cards/' . $boughtgiftcard->gift_card->image)); ?>"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="text-main">
                                                                <?php if($boughtgiftcard->gift_card->type == 1): ?>
                                                                <h3><?php echo e($boughtgiftcard->gift_card->title); ?> |
                                                                    $<?php echo e($boughtgiftcard->gift_card->credit_amount); ?></h3>
                                                                <?php else: ?>
                                                                <h3>Giveaway |
                                                                    $<?php echo e($boughtgiftcard->gift_card->credit_amount); ?></h3>

                                                                <?php endif; ?>
                                                                <ul>
                                                                    <li class="last-child">
                                                                        <button class="btn btn-brown"
                                                                            id="redeemgiftcard"
                                                                            type="submit">reedem</button>
                                                                        <button class="btn btn-yellow" type="button"
                                                                            class="btn btn-secondary"><a
                                                                                href="<?php echo e(url('user/gift-cards/gift-friend')); ?>/<?php echo e($boughtgiftcard->id); ?>"
                                                                                class="anchor-tag">send to a
                                                                                friend</a></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="line"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>



                            </div>
                        </div>
                    </div>

                    <!-- Redeemed Gift Cards  -->

                    <div class="tab-pane" id="redeemedgiftcard">
                        <div class="row column-seperation">
                            <div class="col-sm-9">
                                <!-- <div class="card-deck">
                                    <?php $__currentLoopData = $boughtgiftcards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boughtgiftcard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card">
                                        <form method="POST"
                                            action="<?php echo action('BuyGiftCardController@redeem', ['id' => $boughtgiftcard->id]); ?>">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo e($boughtgiftcard->gift_card->title); ?></h5>
                                                <p class="card-text">
                                                    <?php echo e($boughtgiftcard->gift_card->description); ?>

                                                    <?php if($boughtgiftcard->is_gifted): ?>
                                                    <br /><b>Gifted by: <?php echo e($boughtgiftcard->bought_by->name); ?>

                                                        <?php endif; ?>
                                                        <br /><b>Credit Amount: $
                                                            <?php echo e($boughtgiftcard->gift_card->credit_amount); ?></b>
                                                </p>
                                                <div class="row">
                                                    <button id="redeemgiftcard" type="submit"
                                                        class="btn btn-primary">Redeem</button>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#sendgiftcardModal">
                                                        Send To A Friend
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div> -->

                                <!-- newly added coustom HTMl  -->
                                <?php $__currentLoopData = $redeemedgiftcards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $redeemedgiftcard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="buy-gift">
                                    <ul class="gift-card">
                                        <li class="buy-gift-only">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- background gift image goes here  -->
                                                    <div class="giftcard-redeemed">
                                                        <div class="giftcard-img">
                                                            <img src="<?php echo e(url('assets/img/gift-cards/' . $redeemedgiftcard->gift_card->image)); ?>"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <!-- git card details goes here  -->
                                                    <div class="text-main">
                                                        <?php if($redeemedgiftcard->gift_card['type'] == 1): ?>
                                                        <h3><?php echo e($boughtgiftcard->gift_card['title']); ?> |
                                                            $<?php echo e($redeemedgiftcard->gift_card['credit_amount']); ?></h3>
                                                        <?php else: ?>
                                                        <h3>Giveaway | $<?php echo e($redeemedgiftcard->gift_card->credit_amount); ?>

                                                        </h3>

                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="line"></div>
                                        </li>
                                    </ul>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END card -->
        </div>
    </div>
</div>
<!-- END CONTAINER FLUID -->
</div>

<!-- END PAGE CONTENT -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<!-- END PAGE LEVEL JS -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('new_includes.new_main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>