<div id="editChangePackageModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"> <?php echo app('translator')->get('file.Change Package'); ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="<?php echo e(route('customer.change_package','saastest9')); ?>" id="packageUpdateForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="tenant_id" id="tenantId">
                    <div class="row">
                        <div class="col-md-6">
                            <label><strong><?php echo app('translator')->get('file.Package'); ?></strong></label>
                            <select name="package_id" id="packageIdChange" class="selectpicker form-control">
                                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="updateButtonPackage"><?php echo app('translator')->get('file.Update'); ?></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/peopleprosaas/resources/views/landlord/super-admin/pages/customers/change-package-modal.blade.php ENDPATH**/ ?>