<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="Simple Documentation for project NewsOcean.">
    <meta name="author" content="GeniusOcean">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(url('/')); ?>/assets/images/<?php echo e($settings[0]->favicon); ?>" />

    <title><?php echo e($settings[0]->title); ?> - Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo e(URL::asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo e(URL::asset('assets/css/genius-admin.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets2/css/style.css')); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        window.Laravel = <?php echo json_encode([
                                'csrfToken' => csrf_token(),
                            ]); ?>
    </script>

    <style>
        .field-icon {
            float: right;
            position: relative;
            z-index: 2;
            top: -24px;
            left: -7px;
        }
    </style>
</head>

<body>

    <section id="login">
        <div class="container">
            <!-- <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <h1>Admin Log in</h1>
                    <hr>
                    <div class="text-center" id="res" style="display: none;"></div>
                    <form role="form" method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label for="username" class="sr-only">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Admin Email" required>
                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <?php if($errors->has('email')): ?>
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo e($errors->first('email')); ?>

                            </div>

                        <?php endif; ?>
                        <?php if($errors->has('password')): ?>
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo e($errors->first('password')); ?>

                            </div>
                        <?php endif; ?>
                        <input type="submit" id="admin_btn" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>
                    <hr>
                </div>
            </div>  -->

            <div class="row">
                <div class="col-sm-3 col-xs-12 hidden-xs col-sm-offset-2">
                    <div>
                        <img class="login-logo" src="<?php echo e(url('/assets/img/ube_logo_ig.png')); ?>">
                    </div>
                </div>

                <div class="col-sm-5  col-xs-12">
                    <div class="signIn-area">
                        <h2 class="signIn-title">
                            Administrator Login
                        </h2>
                        <hr />

                        <form action="<?php echo e(route('login')); ?>" method="POST">

                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="email">Email Address <span>*</span></label>
                                <input class="form-control" value="<?php echo e(old('email')); ?>" type="email" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span>*</span></label>
                                <input class="form-control" type="password" name="password" id="reg_password" required>
                                <span toggle="#reg_password" class="fa fa-fw fa-eye field-icon toggle-password_1"></span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a href="<?php echo e(route('admin.reg')); ?>">Create New Account</a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                        <a href="<?php echo e(route('admin.forgotpass')); ?>">Forgot your Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div id="resp">
                                <?php if($errors->has('password')): ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </div>
                                <?php endif; ?>
                                <?php if($errors->has('email')): ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </div>
                                <?php endif; ?>
                                <?php if($message = Session::get('success')): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                                <?php endif; ?>
                                <?php if($message = Session::get('warning')): ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-md login-btn" type="submit" value="LOGIN">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div> <!-- /.container -->
    </section>

    <script src="<?php echo e(URL::asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/jquery.maskedinput.js')); ?>"></script>

    <script>
        $("body").on('click', '.toggle-password_1', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#reg_password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }

        });
    </script>
</body>

</html>