<?php $__env->startSection('content'); ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h3>Admin Dashboard! </h3>
        <div class="row">
        <div class="dashboard-header-area col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Total Products!
                        <span class="product-quantity"><?php echo e(\App\Product::count()); ?></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="<?php echo e(url('admin/products')); ?>">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Orders Shedule!
                        <span class="product-quantity"><?php echo e(\App\Order::where('payment_status','Completed')->where('status','scheduled')->count()); ?></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="<?php echo e(url('admin/orders')); ?>">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Orders Processing!
                        <span class="product-quantity"><?php echo e(\App\Order::where('payment_status','Completed')->where('status','processing')->count()); ?></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="<?php echo e(url('admin/orders')); ?>">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Orders Completed!
                        <span class="product-quantity"><?php echo e(\App\Order::where('payment_status','Completed')->where('status','completed')->count()); ?></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="<?php echo e(url('admin/orders')); ?>">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-bank"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Pending Withdraws!
                        <span class="product-quantity"><?php echo e(\App\Withdraw::where('status','pending')->count()); ?></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="<?php echo e(url('admin/withdraws/pending')); ?>">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Total Customers!
                        <span class="product-quantity"><?php echo e(\App\Clients::count()); ?></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="<?php echo e(url('admin/customers')); ?>">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Vendors Pending!
                        <span class="product-quantity"><?php echo e(\App\Vendors::where('status',0)->count()); ?></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="<?php echo e(url('admin/vendors/pending')); ?>">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-group"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Total Vendors!
                        <span class="product-quantity"><?php echo e(\App\Vendors::count()); ?></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="<?php echo e(url('admin/vendors')); ?>">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-at"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Total Subscribers!
                        <span class="product-quantity"><?php echo e(\App\Subscribers::count()); ?></span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="<?php echo e(url('admin/subscribers')); ?>">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><strong>Top Referrals</strong></div>
                                    <div class="panel-body">
                                        <table class="table" style="margin-bottom: 0">
                                            <tbody>
                                            <?php $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($referral->referral); ?></td>
                                                    <td><?php echo e($referral->total_count); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><strong>Most Used Browser</strong></div>
                                    <div class="panel-body">
                                        <table class="table" style="margin-bottom: 0">
                                            <tbody>
                                            <?php $__currentLoopData = $browsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $browser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($browser->referral); ?></td>
                                                    <td><?php echo e($browser->total_count); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-12" style="padding: 0">
                            <canvas id="lineChart" style="width: 100%"></canvas>
                        </div>

                </div>

            </div>
        </div>



        <div class="row" id="main" >



        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script language="JavaScript">
        displayLineChart();
        function displayLineChart() {
            var data = {
                labels: [
                    <?php echo $days; ?>

                ],
                datasets: [
                    {
                        label: "Prime and Fibonacci",
                        fillColor: "#3dbcff",
                        strokeColor: "#0099ff",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            <?php echo $sales; ?>

                        ]
                    }
                ]
            };
            var ctx = document.getElementById("lineChart").getContext("2d");
            var options = {
                responsive: true
            };
            var lineChart = new Chart(ctx).Line(data, options);
        }
        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.includes.master-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>