<nav class="side-navbar">
    <span class="brand-big">
        
    </span>
    <ul id="side-main-menu" class="side-menu list-unstyled">
        <li><a href="#"> <i class="dripicons-meter"></i><span><?php echo e(__('file.dashboard')); ?></span></a></li>
        <li><a target="_blank" href="<?php echo e(route('landingPage.index')); ?>"> <i class="dripicons-monitor"></i><span>Frontend</span></a></li>

        <li><a href="<?php echo e(route('customer.index')); ?>"><i class="dripicons-list"></i> <?php echo e(trans('file.Customers')); ?></a></li>

        <li><a href=""><i class="dripicons-card"></i> <?php echo e(trans('file.Payments')); ?></a></li>
        <li><a href="#package" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-archive"></i><span><?php echo e(trans('file.Package')); ?></span><span></a>
            <ul id="package" class="collapse list-unstyled ">
                <li id="package-list-menu"><a href="<?php echo e(route('package.index')); ?>"><?php echo e(trans('file.Package List')); ?></a></li>
                <li id="package-create-menu"><a href="<?php echo e(route('package.create')); ?>"><?php echo e(trans('file.Add Package')); ?></a></li>
            </ul>
        </li>
        <li><a href="#cms" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-stack"></i><span><?php echo e(trans('file.CMS')); ?></span><span></a>
            <ul id="cms" class="collapse list-unstyled ">
                <li id="cms-hero-menu"><a href="<?php echo e(route('hero.index')); ?>"><?php echo e(trans('file.Hero Section')); ?></a></li>
                <li id="cms-module-menu"><a href="<?php echo e(route('module.index')); ?>"><?php echo e(trans('file.Module Section')); ?></a></li>
                <li id="cms-feature-menu"><a href="<?php echo e(route('feature.index')); ?>"><?php echo e(trans('file.Feature Section')); ?></a></li>
                <li id="cms-faq-menu"><a href="<?php echo e(route('faq.index')); ?>"><?php echo e(trans('file.FAQ Section')); ?></a></li>
                <li id="cms-testimonial-menu"><a href="<?php echo e(route('testimonial.index')); ?>"><?php echo e(trans('file.Testimonial Section')); ?></a></li>
                <li id="cms-tenant-signup-menu"><a href="<?php echo e(route('tenantSignupDescription.index')); ?>"><?php echo e(trans('file.Tenant Signup Description')); ?></a></li>
                <li id="cms-blog-menu"><a href="<?php echo e(route('blog.index')); ?>"><?php echo e(trans('file.Blog Section')); ?></a></li>
                <li id="cms-page-menu"><a href="<?php echo e(route('page.index')); ?>">  <?php echo e(trans('file.Page Section')); ?></a></li>
                <li id="cms-social-menu"><a href="<?php echo e(route('social.index')); ?>"><?php echo e(trans('file.Social Section')); ?></a></li>
            </ul>
        </li>

        <li><a href="#localization" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-web"></i><span><?php echo e(trans('file.Localization')); ?></span><span></a>
            <ul id="localization" class="collapse list-unstyled ">
                <li id="localization-language-menu"><a href="<?php echo e(route('language.index')); ?>"><?php echo e(trans('file.Language Setting')); ?></a></li>
                
                <li id="localization-translation-menu"><a href="<?php echo e(route('lang.translations.index', config('app.locale'))); ?>"><?php echo e(trans('file.Translation')); ?> </a></li>
                <li id="localization-add-translation-menu"><a href="<?php echo e(route('lang.translations.create', config('app.locale'))); ?>"><?php echo e(trans('file.Add Translation')); ?> </a></li>
            </ul>
        </li>
        <li><a href="<?php echo e(route('setting.general.index')); ?>"><i class="dripicons-gear"></i> <?php echo e(trans('file.Settings')); ?></a></li>
        <li><a target="_blank" href=""> <i class="dripicons-information"></i><span><?php echo e(trans('file.Documentation')); ?></span></a></li>
    </ul>
  </nav>
<?php /**PATH /var/www/peopleprosaas/resources/views/landlord/super-admin/partials/sidebar.blade.php ENDPATH**/ ?>