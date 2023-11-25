
<?php $__env->startSection('title','Refer a Friend'); ?>
<?php $__env->startSection('content'); ?>
    <style>
        ::placeholder {
            /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: red;
            opacity: 1;
            /* Firefox */
        }

        .top-right1 {
            position: absolute !important;
            /* top: 1px; */
            right: 0;
        }

        .font-clr {
            color: #B6B6B6;
        }

        .font-cl1 {
            color: #8533ff;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
            visibility: hidden;
        }
        .code-text-send {
            background-color:#000080;
        }
        .btn-invite {
            background-color:#000080!important;
        }
    </style>
    <div class="content ">
        <div class="container-fluid p-b-50 m-t-40">
            <div>
                <?php if($message = Session::get('message_success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong><?php echo e($message); ?></strong>
                    </div>
                <?php elseif($message = Session::get('message_fail')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong><?php echo e($message); ?></strong>
                    </div>
                <?php endif; ?>
                <?php 
                    $value = 0;
                    if($referral->program->name == 'Sign-up Bonus'){ $value = $referral->program->amount; }
                 ?>
                <div class="row">
                    <div class="col-sm-12 col-md-8" id="refer-column">
                        <div class="refer-img"></div>
                    </div>
                    <div class="col-md-4" id="refer-column" style="background-color: #f0f0f0; padding: 40px">
                        <div>
                            <div>
                                <div class="m-b-20 font-color">
                                    <p> What's better than getting free stuff? Letting your friends in on the secret and sharing the wealth!</p>
                                    <p>As a token of our appreciation for your support, we would like to give you a chance to earn as much free drycleaning and laundry credits as possible.</p>
                                    <p>Simply tell a friend about us, and ask them to sign up with your code. When they do, they will receive $<?php echo e($value); ?> in Credits and so will you!</p>
                                    <p>That Was Easy!</p>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $__empty_1 = true; $__currentLoopData = Auth::guard('profile')->user()->getReferrals(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="row">
                        <div class="col-sm-4 col-md-4" >
                            <div class="code-title">
                                Your Unique Code
                            </div>
                            <div class="code-text-send">
                                <?php echo e($referral->code); ?>

                            </div>
                            <div class="text-center">
                                Referred Users: <?php echo e($referral->relationships()->count()); ?>

                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <p class="msg-of-friend">This is your very own unique code that you can either send by email or text to your friends, so that they can sign up and you both receive bonus credits</p>
                        </div>
                        <div class="col-sm-4 col-md-4"></div>
                    </div>
                    <div class="row">
                        <form class="form-inline" action="<?php echo e(route('shop-user-send-refer-mail')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-sm-12 col-12 setwidthform">
                                <div class="codenandinvi-title">Send invitation and code</div>
                                <div class="form-group" id="send-email-id">
                                    <label for="email" class="sr-only">Email address:</label>
                                    <input type="email" class="form-control" name="email" id="email" style="width: 60%;" placeholder="EMAIL ADDRESS" required>
                                </div>
                                <input type="hidden" class="form-control" name="link" id="code" value="<?php echo e($referral->link); ?>">
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-invite" id="invite-btn">Send invite code</button>
                                <button type="reset" class="btn btn-cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    No referral Programs at the moment
                <?php endif; ?>
            </div>
        </div>
        <!-- END card -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.shop.user.new_main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>