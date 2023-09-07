

<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <!-- Metas -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="LionCoders" />
    <meta name="csrf-token" content="CmSeExxpkZmScDB9ArBZKMGKAyzPqnxEriplXWrS">
    
    <!-- Document Title -->
    
    <title>PeoplePro SAAS</title>
    <!-- Links -->
    

    <!-- Bootstrap CSS -->
    <link href="<?php echo e(url('/')); ?>/landlord/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS-->
    <link rel="preload" href="<?php echo asset('../../vendor/font-awesome/css/font-awesome.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="<?php echo asset('../../vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet"></noscript>

    <!-- Plugins CSS -->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(url('/')); ?>/landlord/css/plugins.css">
    <noscript>
        <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="<?php echo e(url('/')); ?>/landlord/css/plugins.css">
    </noscript>

    <!-- common style CSS -->
    <link href="<?php echo e(url('/')); ?>/landlord/css/common-style.css" rel="stylesheet">

    <!-- google fonts-->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap">
    <noscript>
        <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"
            href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;600&display=swap">
        </noscript>


    <style>
        :root {
            --theme-color: #f16232;
        }

        .pricing {
            background-color: #FFF;
            text-align: center;
        }
        .pricing-header {
            background-color: #733686;
            font-size: 24px;
            padding: 20px 15px;
        }
        .pricing-header .h3 {
            color: #FFF !important;
        }
        .pricing-details p {
            padding: 20px 15px;
        }
        .pricing-details p i {
            font-weight: bold;
        }
        .pricing-details p .ti-check {
            color: green
        }
        .pricing-details p .ti-close {
            color: red
        }
        .pricing-details p:nth-child(even) {
            background-color: #ececec;
        }
        .price {
            align-items: center;
            background-color: #FFF;
            display: flex;
            justify-content: center;
            min-height: 130px;
            padding: 20px 15px;
        }

        .pricing-m {
            background-color: #FFF;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .pricing-m .pricing-header {
            align-items: center;
            background-color: transparent;
            display: flex;
            font-size: 24px;
            padding: 15px;
            width: 70%;
        }
        .pricing-m .pricing-header .h3 {
            color: #141414 !important;
        }
        .pricing-m .price {
            min-height: 80px;
        }
        .pricing-m .price span {
            color: #2aa6de;
            display: block;
            font-size: 20px;
        }
        .currency-code {
            color: #666;
            font-size: 14px;
        }
        .pricing-m .pricing-details:first-child {
            width: 70%
        }
        .pricing-m .pricing-details:last-child {
            text-align: center;
            width: 30%
        }
        .pricing-m .signup {
            padding: 15px;
        }
        .custom-control {
            position: relative;
            z-index: 1;
            display: block;
            min-height: 1.5rem;
            padding-left: 1.5rem;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            print-color-adjust: exact;
        }
        .custom-control-input {
            position: absolute;
            left: 0;
            z-index: -1;
            width: 1rem;
            height: 1.25rem;
            opacity: 0;
        }
        .custom-switch {
            padding-left: 2.25rem;
        }
        .custom-control-label {
            position: relative;
            margin-bottom: 0;
            padding-left: 10px;
            vertical-align: top;
        }
        .custom-switch .custom-control-label::before {
            left: -2.25rem;
            width: 2rem;
            pointer-events: all;
            border-radius: .5rem;
        }
        .custom-control-label::before, .custom-file-label, .custom-select {
            transition: background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .custom-control-label::before {
            position: absolute;
            top: .25rem;
            left: -1.5rem;
            display: block;
            width: 2rem;
            height: 1rem;
            pointer-events: none;
            content: "";
            background-color: #fff;
            border: 1px solid #adb5bd;
        }
        .custom-switch .custom-control-label::after {
            top: calc(.25rem - 1px);
            left: calc(-2.25rem);
            width: calc(1.15rem);
            height: calc(1.15rem);
            background-color: #adb5bd;
            border-radius: .5rem;
            transition: background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-transform .15s ease-in-out;
            transition: transform .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            transition: transform .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-transform .15s ease-in-out;
        }
        .custom-control-label::after {
            position: absolute;
            top: .25rem;
            left: -1.5rem;
            display: block;
            width: 1rem;
            height: 1rem;
            content: "";
            background: 50%/50% 50% no-repeat;
            background-color: rgba(0, 0, 0, 0);
        }
        .custom-control-input:checked ~ .custom-control-label::before {
            color: #fff;
            border-color: #6d4bb0;
            background-color: #6d4bb0;
        }
        .custom-switch .custom-control-input:checked ~ .custom-control-label::after {
            background-color: #fff;
            left: calc(-2rem);
            -webkit-transform: translateX(.75rem);
            transform: translateX(.75rem);
        }
    </style>

    <?php echo $__env->yieldPushContent('css'); ?>


    
</head>

<body>

    <header id="header-middle" class="header-middle">

        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-7">
                    <div class="mobile-menu-icon d-lg-none"><i class="ti-menu"></i></div>
                    <div class="logo">
                        <a href="<?php echo e(url('/')); ?>">
                            <img class="lazy" src="<?php echo e(asset('landlord/images/logo/'. $generalSetting->site_logo)); ?>">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-flex d-xl-flex middle-column justify-content-center">
                    <div id="main-menu" class="main-menu">
                        <ul class="pl-0">
                            <li><a href="<?php echo e(url('/')); ?>#features">Features</a></li>

                            <li><a href="<?php echo e(url('/')); ?>#faq">FAQ</a></li>

                            <li><a href="<?php echo e(url('/')); ?>#packages">Pricing</a></li>

                            <li><a href="<?php echo e(url('/blogs')); ?>">Blogs</a></li>
                            
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-5" style="text-align:right">
                    <ul class="offset-menu-wrapper p-0 d-none d-lg-flex d-xl-flex">
                        <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e($social->link); ?>"><i class="<?php echo e($social->icon); ?>"></i></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        <li>
                            <a class="button style2" href="#packages">Try Now</a>
                        </li>
                    </ul>
                    <a class="button style2 d-lg-none" href="#packages">Try Now</a>
                </div>
            </div>
        </div>
        <nav id="mobile-nav"></nav>
    </header>
    <?php echo $__env->yieldContent('public-content'); ?>

    <!-- Footer section Starts-->
    <div class="footer-wrapper pt-0">
        <div class="container">
            <div class="footer-links">
                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(url('pages/'.$page->slug)); ?>"><?php echo e($page->title); ?> &nbsp; <?php if($key !== (count($pages)-1)): ?> | <?php endif; ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="footer-bottom">
                <ul class="footer-social p-0 pt-3 pb-3">
                    <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e($social->link); ?>"><i class="<?php echo e($social->icon); ?>"></i></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                
            </div>
        </div>
    </div>
    <!-- Footer section Ends-->

    <!--Scroll to top starts-->
    <a href="#" id="scrolltotop"><i class="ti-arrow-up"></i></a>
    <!--Scroll to top ends-->

    <div class="body__overlay"></div>

    <!-- Cookie consent Starts-->


    <!-- Cookie consent Ends-->


    <!--Plugin js -->
    <script src="landlord/js/plugin.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <!-- Sweetalert2 -->
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main js -->
    <script src="landlord/js/main.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/payment/razorpay.js')); ?>"></script>

    
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

    <?php if(isset($general_setting->ga_script)): ?>
    <?php echo $general_setting->ga_script; ?>

    <?php endif; ?>

    <?php if(isset($general_setting->chat_script)): ?>
    <?php echo $general_setting->chat_script; ?>

    <?php endif; ?>

    <?php if(env('USER_VERIFIED')==0): ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-D0S4KHQ1D6"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-D0S4KHQ1D6');
    </script>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>

<?php /**PATH /var/www/peopleprosaas/resources/views/landlord/public-section/layouts/master.blade.php ENDPATH**/ ?>