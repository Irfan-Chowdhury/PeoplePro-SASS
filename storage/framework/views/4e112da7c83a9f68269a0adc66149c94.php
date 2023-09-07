<?php $__env->startSection('public-content'); ?>

<?php $__env->startPush('css'); ?>
    <style>
    .loading-icon {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .loading-icon i {
        font-size: 40px;
        color: #333;
    }
</style>
<?php $__env->stopPush(); ?>



    <!--Header-->
    <!--Header Area starts-->
    <?php if(!env('USER_VERIFIED')): ?>
    <div class="d-block text-center"><a class="button style1 w-100" href="https://lion-coders.com/software/salepro-saas">Buy Salepro SAAS</a></div>
    <?php endif; ?>

    <section class="hero mt-0">
        <div class="container">
            <div id="loading-icon" class="loading-icon">
                <i class="fa fa-spinner fa-spin"></i> Processing...
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center hero-text mb-5">
                    <h1 class="heading"><?php echo e($hero->heading); ?></h1>
                    <h2 class="light h5 mb-3"><?php echo e($hero->sub_heading); ?></h2>
                    <a href="#packages" class="button style1"><?php echo e($hero->button_text); ?></a>
                </div>
                <div class="col-md-8 offset-md-2">
                    <img class="hero-img" src="<?php echo e(asset('landlord/images/hero/'.$hero->image)); ?>" alt=""/>
                </div>
            </div>
        </div>
    </section>



    <section id="features" class="">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center mb-5">
                    <h2 class="regular"><?php echo e($module->heading); ?></h2>
                    <p class="lead mb-5"><?php echo e($module->sub_heading); ?></p>
                </div>
                <div class="col-md-5">
                    <?php if(isset($module) && $module->image): ?>
                        <img class="mb-5" src="<?php echo e(asset('landlord/images/module/'.$module->image)); ?>" alt="Module image"/>
                    <?php else: ?>
                        <img class="mb-5" src="landlord/images/preview.png" alt=""/>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="row">
                        <?php $__currentLoopData = $module->moduleDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 feature">
                            <div class="icon">
                                <i class="<?php echo e($module->icon); ?>"></i>
                            </div>
                            <h3><?php echo e($module->name); ?></h3>
                            <p><?php echo e($module->description); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(count($features) > 0): ?>
    <section class="grey-bg">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 feature2">
                    <div class="icon">
                        <i class="<?php echo e($feature->icon); ?>"></i>
                    </div>
                    <h4 class="h6"><?php echo e($feature->name); ?></h4>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if(isset($faq)): ?>
        <section id="faq" class="accordion pb-0" id="accordionExample">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center mb-5">
                        <h2 class="regular"><?php echo e($faq->heading); ?></h2>
                        <p class="lead"><?php echo e($faq->sub_heading); ?></p>
                    </div>
                    <div class="col-md-6 offset-md-3 mb-5">
                        <?php $__currentLoopData = $faq->faqDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo e($key); ?>" aria-expanded="false" aria-controls="collapse1">
                                    <?php echo e($item->question); ?>

                                </button>
                                </h2>
                                <div id="collapse-<?php echo e($key); ?>" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $item->answer; ?>

                                    </div>
                                </div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>



    <!-- Pricing Plan -->

    <section id="packages"class="grey-bg">
        <div class="container">
            <div class="col-md-6 offset-md-3 text-center mb-5">
                <h2 class="regular"><?php echo app('translator')->get('file.Pricing plans'); ?></h2>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="plan_type">
                    <label class="custom-control-label" for="plan_type"><?php echo app('translator')->get('file.Show Yearly Price'); ?></label>
                </div>
            </div>
            <div class="d-none d-lg-flex d-xl-flex justify-content-between mb-5">
                <?php if($packages): ?>
                    <div class="col">
                        <div class="pricing">
                            <div class="pricing-header">
                                <span class="h3"><?php echo app('translator')->get('file.Plan'); ?></span>
                            </div>
                            <div class="price">
                                <span class="h4"><?php echo app('translator')->get('file.Price'); ?></span>
                            </div>
                            <div class="pricing-details">
                                <p class="bold"><?php echo e(trans('file.Free Trial')); ?></p>
                                <?php $__currentLoopData = $saasFeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $delimiter = '-';
                                        if (strpos($item, '_') !== false) {
                                            $delimiter = '_';
                                        }
                                        $words = explode($delimiter, $item);
                                        $convertedString = implode(' ', array_map('ucfirst', $words));
                                    ?>
                                    <p class="bold"><?php echo e($convertedString); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="pricing">
                                <div class="pricing-header">
                                    <span class="h3"><?php echo e($package->name); ?></span>
                                </div>
                                <div class="price">
                                    <div>
                                        <span class="h4"><span class="currency-code"><?php echo e($generalSetting->currency_code); ?></span> <span class="package-price" data-monthly="<?php echo e($package->monthly_fee); ?>" data-yearly="<?php echo e($package->yearly_fee); ?>"><?php echo e($package->monthly_fee); ?>/month</span></span><br>
                                        <button href="#customer-signup" data-free="<?php echo e($package->is_free_trial); ?>" data-package_id="<?php echo e($package->id); ?>" class="button style2 signup-btn">Sign Up</button>
                                    </div>
                                </div>
                                <div class="pricing-details">

                                    <?php if($package->is_free_trial): ?>
                                        <p><?php echo e($generalSetting->free_trial_limit); ?> days</p>
                                    <?php else: ?>
                                        <p>N/A</p>
                                    <?php endif; ?>

                                    <?php
                                        $selectedFeatures = explode(',',$package->features);
                                    ?>

                                    <?php $__currentLoopData = $saasFeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(in_array($item, $selectedFeatures)): ?>
                                            <p><i class="ti-check"></i></p>
                                        <?php else: ?>
                                            <p><i class="ti-close"></i></p>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="grey-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center mb-5">
                    <h2 class="regular"><?php echo e(__('file.Testimonials')); ?></h2>
                </div>
            </div>
            <div class="swiper mySwiper swiper-container-horizontal swiper-container-autoheight">
                <div class="swiper-wrapper" style="height: 348px;">
                <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="swiper-slide swiper-slide-active" style="width: 563px; margin-right: 50px;">
                        <div class="review">
                            <div class="review-text">
                                <?php echo $testimonial->description; ?>

                            </div>
                            <div class="reviewer"><img src="<?php echo e(asset('landlord/images/testimonial')); ?>/<?php echo e($testimonial->image); ?>" alt="<?php echo e($testimonial->name); ?>" /> <?php echo e($testimonial->name); ?><?php if($testimonial->business_name): ?>, <?php echo e($testimonial->business_name); ?><?php endif; ?></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
                </div>
                <div class="swiper-nav-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"><i class="ti-arrow-right"></i></div>
                <div class="swiper-nav-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"><i class="ti-arrow-left"></i></div>
                <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </div>
    </section>

    <section id="customer-signup">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center mb-3">
                    <?php if($tenantSignupDescription): ?>
                        <h2 class="regular"><?php echo e($tenantSignupDescription->heading); ?></h2>
                        <p class="lead mb-3"><?php echo e($tenantSignupDescription->sub_heading); ?></p>
                    <?php else: ?>
                        <h2 class="regular">Customer Sign Up</h2>
                        <p class="lead mb-3">Peoplepro is packed with all the features you'll need to seamlessly run your business</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6 offset-md-3 mb-5">
                <form action="<?php echo e(route('customer.signup')); ?>" method="POST"  class="form row customer-signup-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="package_id">
                    <input type="hidden" name="subscription_type" value="monthly">
                    <input type="hidden" name="price">

                    <div class="col-6">
                        <input class="form-control" type="text" name="first_name"  placeholder="First Name..." required>
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="text" name="last_name"  placeholder="Last Name..." required>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="number" name="contact_no"  placeholder="Contact Number..." required>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="email" name="email"  placeholder="Email..." required>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="username"  placeholder="Username..." required>
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="text" name="company_name"  placeholder="Company Name..." required>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="password" name="password"  placeholder="Password..." required>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="password" name="password_confirmation"  placeholder="Confirm Password..." required>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group mt-3">
                            <input required class="form-control mt-0" type="text" name="tenant"  placeholder="Subdomain..." aria-label="ubdomain..." aria-describedby="basic-addon2">
                          <span class="input-group-text" id="basic-addon2"><?php echo e('@'.env('CENTRAL_DOMAIN')); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="card-element" class="form-control">
                        </div>
                        <div class="card-errors" role="alert"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <p id="waiting-msg mb-3"></p>
                        <input id="submitBtn" type="submit" class="button style1 d-block w-100" value="<?php echo e(trans('file.submit')); ?>">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php if(count($blogs) > 0): ?>
    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center mb-5">
                    <h2 class="regular"><?php echo e(__('file.Blog')); ?></h2>
                </div>
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <a href="<?php echo e(route('landingPage.blogDetail',$blog->slug)); ?>">
                        <img src="<?php echo e(asset('landlord/images/blog')); ?>/<?php echo e($blog->image); ?>" alt="<?php echo e($blog->title); ?>"/>
                        <h4 class="mt-3"><?php echo e($blog->title); ?></h4>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 offset-md-3 text-center mt-3 mb-5">
                    <a href="<?php echo e(url('blogs')); ?>" class="button style1"><?php echo e(__('file.All Blogs')); ?></a>
                </div>
            </div>
        </div>

    </section>
    <?php endif; ?>

    

<?php $__env->stopSection(); ?>





<?php $__env->startPush('scripts'); ?>

<script>
    (function ($) {
        "use strict";

        $("#plan_type").change(function(){
            if($("#plan_type").is(':checked')){
                $('input[name=subscription_type]').val('yearly');

                $(".package-price").each(function(){
                    var plan = $(this).data('yearly')+'/year';
                    $(this).html(plan);
                })
            }
            else {
                $('input[name=subscription_type]').val('monthly');
                $(".package-price").each(function(){
                    var plan = $(this).data('monthly')+'/month';
                    $(this).html(plan);
                })
            }
        });

        $(".signup-btn").on("click", function () {
            $('input[name=package_id]').val($(this).data('package_id'));
            if($('input[name=subscription_type]').val() == 'monthly') {
                $('input[name=price]').val($(this).parent().parent().find('.package-price').data('monthly'));
            } else {
                $('input[name=price]').val($(this).parent().parent().find('.package-price').data('yearly'));
            }
            $('html, body').animate({
                scrollTop: $("#customer-signup").offset().top
            });
        });

        $("#submitBtn").click(function(event){
            // event.preventDefault();

            // Call the function to start the task
            simulateTimeConsumingTask();
        });

        // simulateTimeConsumingTask();

        // Function to show the loading icon


    })(jQuery);
</script>

<script>
    function showLoadingIcon() {
        $('#loading-icon').css('display', 'flex');
    }

    function hideLoadingIcon() {
        $('#loading-icon').css('display', 'none');
    }

    function simulateTimeConsumingTask() {
        showLoadingIcon(); // Show the loading icon before the task starts
        setTimeout(function () {
        }, 3000);
    }
</script>

<?php if($errors->any()): ?>
    <script>
        $(document).ready(function() {
            hideLoadingIcon();
            let errorMessages = <?php echo json_encode($errors->all(), 15, 512) ?>;
            htmlContent = "";
            errorMessages.forEach(function(errorMsg) {
                htmlContent += '<p class="text-danger">' + errorMsg + '</p>';
            });
            console.log(htmlContent);
            displayErrorMessage(htmlContent);
        });
    </script>
<?php endif; ?>

<?php if(session()->has('success')): ?>
    <script>
        $(document).ready(function() {
            hideLoadingIcon();
            displaySuccessMessage('<?php echo e(Session::get('success')); ?>');
        });
    </script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo e(asset('js/landlord/common-js/alertMessages.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('landlord.public-section.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/peopleprosaas/resources/views/landlord/public-section/pages/landing-page/index.blade.php ENDPATH**/ ?>