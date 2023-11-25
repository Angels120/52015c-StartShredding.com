<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Page Settings</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="res">
                            <?php if(Session::has('message')): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo e(Session::get('message')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- /.start -->
                        <div class="col-md-12">
                            <ul class="nav nav-tabs tabs-left">
                                <li class="active"><a href="#faq" data-toggle="tab" aria-expanded="true">FAQ Page</a>
                                </li>
                                <li><a href="#brands" data-toggle="tab" aria-expanded="false">Brand Logos</a></li>
                                <li><a href="#banners" data-toggle="tab" aria-expanded="false">Home Banners</a></li>
                                <li><a href="#largeBanner" data-toggle="tab" aria-expanded="false">Large Home Banners</a></li>
                                <li><a href="#about" data-toggle="tab" aria-expanded="false">About Us Page</a></li>
                                <li><a href="#contact" data-toggle="tab" aria-expanded="false">Contact Us Page</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-xs-12">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane" id="about">
                                    <p class="lead">About Us Page</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="<?php echo e(action('PageSettingsController@about')); ?>" class="form-horizontal form-label-left">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook"> Disable/Enable About Page <span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-3 col-xs-9">
                                                <?php if($pagedata->a_status == 1): ?>
                                                    <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="a_status" value="1" data-off="Disabled" checked>
                                                <?php else: ?>
                                                    <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="a_status" value="1" data-off="Disabled">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook"> About Us Page Content <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea rows="10" class="form-control" name="about" id="content1" placeholder="About Page Contents" required="required"><?php echo e($pagedata->about); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button id="about_page_update" type="submit" class="btn btn-success btn-block">Update About Page</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="contact">
                                    <p class="lead">Contact Page Content</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="<?php echo e(action('PageSettingsController@contact')); ?>" class="form-horizontal form-label-left">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook"> Disable/Enable Contact Page <span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-3 col-xs-9">
                                                <?php if($pagedata->c_status == 1): ?>
                                                    <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="c_status" value="1" data-off="Disabled" checked>
                                                <?php else: ?>
                                                    <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="c_status" value="1" data-off="Disabled">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook"> Contact Form Success Text <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea rows="3" class="form-control" name="contact" placeholder="Contact Page Content" required="required"><?php echo e($pagedata->contact); ?></textarea>
                                            </div>

                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook"> Contact Us Email Address <span class="required">*</span>
                                                <p class="small-label">Separate by Comma(,) for Multiple Email</p>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea rows="3" class="form-control" name="contact_email" placeholder="Contact Us Email Address" required="required"><?php echo e($pagedata->contact_email); ?></textarea>
                                            </div>

                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button id="contact_page_update" type="submit" class="btn btn-success btn-block">Update Contact Page</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane active" id="faq">
                                    <div class="pull-right">
                                        <a href="<?php echo url('admin/faq/add'); ?>" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New FAQ</a>
                                    </div>
                                    <p class="lead">FAQ Page</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="<?php echo e(action('PageSettingsController@faq')); ?>" class="form-horizontal form-label-left">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook"> Disable/Enable FAQ Page <span class="required">*</span>
                                            </label>
                                            <div class="col-md-2 col-sm-3 col-xs-6">
                                                <?php if($pagedata->f_status == 1): ?>
                                                    <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="f_status" value="1" data-off="Disabled" checked>
                                                <?php else: ?>
                                                    <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="f_status" value="1" data-off="Disabled">
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                                <button id="faq_page_update" type="submit" class="btn btn-success">Apply</button>
                                            </div>
                                        </div>

                                    </form>
                                    <p class="lead">All FAQs</p>
                                    <table class="table" id="example">
                                        <thead>
                                        <tr>
                                            <th width="35%">Questions</th>
                                            <th width="45%">Answers</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($faq->question); ?></td>
                                                <td><?php echo e(substr(strip_tags($faq->answer),0,150)); ?></td>
                                                <td>
                                                    <a href="faq/<?php echo e($faq->id); ?>/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                                    <a href="faq/<?php echo e($faq->id); ?>/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="brands">
                                    <div class="pull-right">
                                        <a href="<?php echo url('admin/brand/add'); ?>" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Logo</a>
                                    </div>
                                    <p class="lead">Brand Logos</p>
                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th width="35%">Brand Logo</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><img src="<?php echo e(url('assets/images/brands')); ?>/<?php echo e($brand->image); ?>"></td>
                                                <td>
                                                    
                                                    <a href="brand/<?php echo e($brand->id); ?>/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="banners">
                                    <div class="pull-right">
                                        <a href="<?php echo url('admin/banner/add'); ?>" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add New Banner</a>
                                    </div>
                                    <p class="lead">Home Banners</p>
                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th width="35%">Banner</th>
                                                <th width="45%">HyperLink</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><img style="max-width: 250px;" src="<?php echo e(url('assets/images/brands')); ?>/<?php echo e($banner->image); ?>"></td>
                                                <td><?php echo e($banner->link); ?></td>
                                                <td>
                                                    <a href="banner/<?php echo e($banner->id); ?>/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                                    <a href="banner/<?php echo e($banner->id); ?>/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="largeBanner">
                                    <p class="lead">Large Banner</p>
                                    <div class="ln_solid"></div>
                                    <form method="POST" action="banner/large" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Current Large Banner <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <img class="col-md-10" src="../assets/images/<?php echo e($pagedata->large_banner); ?>">
                                            </div>

                                        </div><br>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Setup New Banner <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" name="large_banner" />
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Large Banner Link <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12" name="banner_link" placeholder="Large Banner Link" required="required" type="text" value="<?php echo e($pagedata->banner_link); ?>">
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button type="submit" class="btn btn-success btn-block">Update Large Banner</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.end -->
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
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel : true}).panelInstance('content1');
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.includes.master-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>