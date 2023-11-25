<?php $__env->startSection('content'); ?>


    <section style="background: url(<?php echo e(url('/')); ?>/assets/images/<?php echo e($settings[0]->background); ?>) no-repeat center center; background-size: cover;">
        <div class="row" style="background-color:rgba(0,0,0,0.7);">

            <div style="margin: 3% 0px 3% 0px;">
                <div class="text-center" style="color: #FFF;padding: 20px;">
                    <h1><?php echo e($language->contact_us); ?></h1>
                </div>
            </div>

        </div>
    </section>

    <div class="home-wrapper">
        <!-- Starting of contact us area -->
        <div class="section-padding contact-area-wrapper wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="contact-area-fullDiv">
                            <p><?php echo e($language->contact_us_today); ?></p>
                            <div class="comments-area">
                                <div class="comments-form">
                                    <form action="<?php echo e(action('FrontEndController@contactmail')); ?>" method="POST">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="to" value="<?php echo e($pagedata->contact_email); ?>">
                                        <!-- Success message -->
                                        <?php if(Session::has('cmail')): ?>
                                            <div class="alert alert-success" role="alert" id="success_message">
                                                <?php echo e(Session::get('cmail')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input name="name" type="text" placeholder="Your Name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="phone" type="tel" placeholder="Your Phone">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input name="email" type="email" placeholder="Your Email" required>
                                            </div>
                                        </div>
                                        <p><textarea name="message" id="comment" placeholder="Write a Replay" cols="30" rows="10" required></textarea></p>
                                        <input name="contact_btn" type="submit" value="Send Message">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <div class="contact-info-div">
                            <p class="contact-info">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <?php echo e($settings[0]->address); ?>

                            </p>
                            <?php if($settings[0]->phone != null): ?>
                                <p class="contact-info">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    Phone :  <a href="tel:<?php echo e($settings[0]->phone); ?>"><?php echo e($settings[0]->phone); ?></a><br/>
                                </p>
                            <?php endif; ?>
                            <?php if($settings[0]->fax != null): ?>
                                <p class="contact-info">
                                    <i class="fa fa-fax" aria-hidden="true"></i>
                                    Fax :  <a href="tel:<?php echo e($settings[0]->fax); ?>"><?php echo e($settings[0]->fax); ?></a><br/>
                                </p>
                            <?php endif; ?>
                            <p class="contact-info">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                Site :  <a href="<?php echo e(url('/')); ?>"><?php echo e($_SERVER['SERVER_NAME']); ?></a><br/>
                            </p>
                            <p class="contact-info">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                Email :  <a href="mailto:<?php echo e($settings[0]->email); ?>"><?php echo e($settings[0]->email); ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of contact us area -->
    </div>




    
    
    
        
            
                
                    
                        
                        
                        

                        
                            
                            
                            
                            
                            
                                
                            
                            
                            
                            
                                
                                    
                                    
                                

                                
                                    
                                    
                                
                            
                            
                                
                                    
                                    
                                

                                
                                    
                                        
                                        
                                        
                                        
                                    
                                    
                                
                            
                            
                                
                                    
                                    
                                
                            

                            
                            
                            
                                
                                
                                    
                                
                            
                        
                    
                
            
        
    
    


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.newmaster', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>