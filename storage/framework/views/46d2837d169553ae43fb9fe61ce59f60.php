

<!-- navbar-->
<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="dripicons-menu"> </i></a>
                <span class="brand-big" id="site_logo_main">
                    
						
                        <img src="<?php echo e(asset('/images/logo/logo.png')); ?>" width="140" height="70">
                        &nbsp; &nbsp;
                    
                </span>


                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <li class="nav-item">
                        <a class="dropdown-header-name" style="padding-right: 10px" href="" data-toggle="tooltip" title="Clear all cache with refresh"><i class="fa fa-refresh"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-header-name" style="padding-right: 10px" href="<?php echo e(route('landingPage.index')); ?>" target="_blank" title="View Website"><i class="dripicons-preview"></i></a>
                    </li>
                    <li class="nav-item"><a id="btnFullscreen" data-toggle="tooltip"
                                            title="<?php echo e(__('Full Screen')); ?>"><i class="dripicons-expand"></i></a></li>
                    <li class="nav-item">
                        <a rel="nofollow" id="notify-btn" href="#" class="nav-link dropdown-item" data-toggle="tooltip"
                           title="<?php echo e(__('Notifications')); ?>">
                            <i class="dripicons-bell"></i>
                            
                            <span class="badge badge-danger">
                                5
                            </span>
                        </a>
                        <ul class="right-sidebar">
                            <li class="header">
                                <span class="pull-right"><a href=""><?php echo e(__('Clear All')); ?></a></span>
                                <span class="pull-left"><a href=""><?php echo e(__('See All')); ?></a></span>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a rel="nofollow" href="#" class="nav-link dropdown-item" data-toggle="tooltip"
                           title="<?php echo e(__('Language')); ?>">
                            <i class="dripicons-web">
                                
                                <?php echo e(Session::has('TempSuperAdminLocale') ? strtoupper(Session::get('TempSuperAdminLocale')) : strtoupper(Session::has('DefaultSuperAdminLocale'))); ?>


                            </i>
                        </a>
                        <ul class="right-sidebar">
                            <?php if(config('database.connections.peopleprosaas_landlord')): ?>
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('lang.switch',$lang->locale)); ?>"><?php echo e($lang->name.' ('.$lang->locale.')'); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('lang.switch',$lang)); ?>"><?php echo e($lang); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </li>

                
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank" data-toggle="tooltip"
                           title="<?php echo e(__('Documentation')); ?>">
                            <i class="dripicons-information"></i>
                        </a>
                    </li>
                

                    <li class="nav-item">
                        <a rel="nofollow" href="#" class="nav-link dropdown-item">
                            

                            
                            <img class="profile-photo sm mr-1" src="<?php echo e(asset('uploads/profile_photos/avatar.jpg')); ?>">
                             <span> Admin</span>
                        </a>
                        <ul class="right-sidebar">
                            <li>
                                <a href="#">
                                    <i class="dripicons-user"></i>
                                    <?php echo e(trans('file.Profile')); ?>

                                </a>
                            </li>
                            
                                <li id="empty_database">
                                    <a href="#">
                                        <i class="dripicons-stack"></i>
                                        <?php echo e(__('Empty Database')); ?>

                                    </a>
                                </li>
                            
                            
                                <li id="export_database">
                                    <a href="#">
                                        <i class="dripicons-cloud-download"></i>
                                        <?php echo e(__('Export Database')); ?>

                                    </a>
                                </li>
                            
                            <li>
                                <form id="logout-form" action="<?php echo e(route('landlord.logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-link" type="submit"><i class="dripicons-exit"></i> <?php echo e(trans('file.logout')); ?></button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
</header>
<?php /**PATH /var/www/peopleprosaas/resources/views/landlord/super-admin/partials/header.blade.php ENDPATH**/ ?>