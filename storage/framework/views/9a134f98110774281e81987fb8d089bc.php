<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('vendor/translation/css/main.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('landlord-content'); ?>

    <div class="container-fluid mb-3">

        <?php echo $__env->make('includes.session_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <h4 class="font-weight-bold mt-3"> <?php echo app('translator')->get('file.Add Translation'); ?></h4>
        <div id="alert_message" role="alert"></div>
        <br>
    </div>

    <div class="panel w-1/2">

        <form action="<?php echo e(route('lang.translations.store', $language)); ?>" method="POST">

            <fieldset>

                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <div class="panel-body p-4">

                    <?php echo $__env->make('translation::forms.text_file', ['field' => 'group', 'placeholder' => __('translation::translation.group_placeholder')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('translation::forms.text', ['field' => 'key', 'label' => __('file.Key'), 'placeholder' => __('e.g :  English')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('translation::forms.text', ['field' => 'value', 'label' => __('file.value'), 'placeholder' => __('e.g : en')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </div>

            </fieldset>

            <div class="panel-footer flex flex-row-reverse">

                <button class="button button-blue">
                    <?php echo e(__('file.Save')); ?>

                </button>

            </div>

        </form>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('public/vendor/translation/js/app.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('landlord.super-admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/peopleprosaas/resources/views/landlord/super-admin/pages/translations/create.blade.php ENDPATH**/ ?>