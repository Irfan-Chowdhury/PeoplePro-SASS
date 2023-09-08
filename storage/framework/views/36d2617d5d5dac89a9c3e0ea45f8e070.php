<div class="input-group">
    <input
        class="<?php if($errors->has($field)): ?> error <?php endif; ?>"
        name="<?php echo e($field); ?>"
        id="<?php echo e($field); ?>"
        type="hidden"
        placeholder="<?php echo e(isset($placeholder) ? $placeholder : ''); ?>"
        value="file"
        readonly
        <?php echo e(isset($required) ? 'required' : ''); ?>>
    <?php if($errors->has($field)): ?>
        <?php $__currentLoopData = $errors->get($field); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p class="error-text"><?php echo htmlspecialchars_decode($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/peopleprosaas/resources/views/vendor/translation/forms/text_file.blade.php ENDPATH**/ ?>