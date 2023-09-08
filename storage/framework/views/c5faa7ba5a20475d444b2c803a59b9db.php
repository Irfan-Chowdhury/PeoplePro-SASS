<div id="editRenewModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"> <?php echo app('translator')->get('file.Renew Subscription'); ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" id="updateRenewForm">
                    <input type="hidden" name="tenant_id" id="modelId">

                    <div class="row">

                        <?php echo $__env->make('landlord.super-admin.partials.input-field', [
                            'colSize' => 6,
                            'labelName' => 'Expiry Date',
                            'fieldType' => 'date',
                            'nameData' => 'expiry_date',
                            'placeholderData' => null,
                            'idData' => 'expiryDate',
                            'isRequired' => true,
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold"><?php echo e(trans('file.Subscription Type')); ?> *</label>
                            <div class="form-check">
                                <input type="radio" id="subscriptionType1" name="subscription_type" value="free" class="form-check-input" required>
                                <label class="form-check-label" for="subscription-type-1">
                                    <?php echo app('translator')->get('file.Free'); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="subscriptionType2" name="subscription_type" value="monthly" class="form-check-input" required>
                                <label class="form-check-label" for="subscription-type-1">
                                    <?php echo app('translator')->get('file.Monthly'); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="subscriptionType3" name="subscription_type" value="yearly" class="form-check-input" required>
                                <label class="form-check-label" for="subscription-type-2">
                                    <?php echo app('translator')->get('file.Yearly'); ?>
                                </label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="updateButtonRenew"><?php echo app('translator')->get('file.Update'); ?></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/peopleprosaas/resources/views/landlord/super-admin/pages/customers/renew-modal.blade.php ENDPATH**/ ?>