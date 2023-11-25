<div class="dashboard-menu">
    <h3>my account</h3>
    <ul class="dashboard-mainmenu">
        <li><a href="<?php echo e(route('logout')); ?>"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off"></i> Logout
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo e(csrf_field()); ?>

            </form></li>
        <li><a href="<?php echo e(route('user.account')); ?>">account dashboard</a></li>
        <li><a href="<?php echo e(route('user.accinfo')); ?>">account information</a></li>
        <li><a href="<?php echo e(route('user.accpass')); ?>">Change Password</a></li>
        <li><a href="<?php echo e(route('user.orders')); ?>">my orders</a></li>
    </ul>
</div>