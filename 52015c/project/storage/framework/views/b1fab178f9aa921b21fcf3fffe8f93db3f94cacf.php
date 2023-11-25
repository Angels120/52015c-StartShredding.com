
<?php $__env->startSection('title','My Orders'); ?>
<?php $__env->startSection('content'); ?>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid p-b-50 m-t-40">

            <div class="row">
                <div class="col-sm-12 p-b-5" style="border-color: black !important">
                    <div class="card card-default">
                        <div class="padding-25">
                            <div class="pull-left">
                                <div class="no-margin ube-card-title">My Orders</div>
                                <p class="no-margin">Recent Orders</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget-11-2-table">
                            <table class="table table-hover table-condensed table-responsive" id="tableStore1" style="width:100%">
                                <thead>
                                <tr class="text-center">
                                    <th  class="all-caps">Date</th>
                                    <th style=" white-space: nowrap;" class="all-caps">Order ID</th>
                                    <th  class="all-caps">Amount</th>
                                    <th class="all-caps">Status <i class="fa fa-question-circle"
                                                                   style="color:white;" aria-hidden="true"></i></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <td class="fs-12"><?php echo e(date('m/d/Y', strtotime($order->booking_date))); ?></td>
                                        <td class="fs-12"><a
                                                    href="<?php echo e(url('/shop-order-details/')); ?>/<?php echo e($order->id); ?>"><u><?php echo e($order->id); ?></u></a>
                                        </td>

                                        <td class="fs-12"><?php echo e($settings[0]->currency_sign); ?><?php echo e(number_format($order->pay_amount, 2)); ?></td>
                                        <?php if($order->status=='scheduled'||$order->status=='in transit'||$order->status=='at
                                        plant'||$order->status=='at
                                        plant completed'): ?>
                                            <td class="fs-12">
                                                <button class="btn schedule-btn btn-cons btn-block"
                                                        type="button"><span>scheduled</span>
                                                </button>
                                            </td>
                                        <?php elseif($order->status=='completed'||$order->status=='completed at store'): ?>
                                            <td class="fs-12">
                                                <button class="btn complete-btn btn-cons btn-block"
                                                        type="button"><span>completed</span>
                                                </button>
                                            </td>
                                        <?php else: ?>
                                            <td class="fs-12">
                                                <button class="btn ondelivery-btn btn-cons btn-block" type="button"><span>on
                                                delivery</span>
                                                </button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- END CONTAINER FLUID -->

    </div>
    <!-- END PAGE CONTENT -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function (e) {
            $("#tableStore1").dataTable({
                // "sDom": "<'top'f<'clear'>><t><'row'<p i>>",
                "destroy": true,
                "order": [],
                "scrollCollapse": true,
                "bLengthChange": false,
                "columns": [
                    { "width": "30%" },
                    { "width": "30%" },
                    { "width": "50%" },
                    { "width": "50%" },
                ],
                "oLanguage": {
                    "sLengthMenu": "_MENU_ ",
                    "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
                },
                "iDisplayLength": 5
            })
        })
    </script>
    <!-- END PAGE LEVEL JS -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.shop.user.new_main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>