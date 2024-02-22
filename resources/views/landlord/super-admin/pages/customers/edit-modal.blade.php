<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"> @lang('file.Edit Customer') </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" id="updateForm">
                    <input type="hidden" name="tenant_id">
                    <input type="hidden" name="customer_id" id="modelId">

                    <div class="row">

                        @include('landlord.super-admin.partials.input-field', [
                            'colSize' => 6,
                            'labelName' => 'First Name',
                            'fieldType' => 'text',
                            'nameData' => 'first_name',
                            'placeholderData' => 'First Name',
                            'isRequired' => false,
                        ])
                        @include('landlord.super-admin.partials.input-field', [
                            'colSize' => 6,
                            'labelName' => 'Last Name',
                            'fieldType' => 'text',
                            'nameData' => 'last_name',
                            'placeholderData' => 'Last Name',
                            'isRequired' => false,
                        ])
                        @include('landlord.super-admin.partials.input-field', [
                            'colSize' => 6,
                            'labelName' => 'Contact No',
                            'fieldType' => 'number',
                            'nameData' => 'contact_no',
                            'placeholderData' => '123456789',
                            'isRequired' => false,
                        ])
                        @include('landlord.super-admin.partials.input-field', [
                            'colSize' => 6,
                            'labelName' => 'Email',
                            'fieldType' => 'text',
                            'nameData' => 'email',
                            'placeholderData' => 'Email',
                            'isRequired' => false,
                        ])
                        @include('landlord.super-admin.partials.input-field', [
                            'colSize' => 6,
                            'labelName' => 'Username',
                            'fieldType' => 'text',
                            'nameData' => 'username',
                            'placeholderData' => 'Username',
                            'isRequired' => false,
                        ])
                        @include('landlord.super-admin.partials.input-field', [
                            'colSize' => 6,
                            'labelName' => 'Company Name',
                            'fieldType' => 'text',
                            'nameData' => 'company_name',
                            'placeholderData' => 'Company Name',
                            'isRequired' => false,
                        ])
                        @include('landlord.super-admin.partials.input-field', [
                            'colSize' => 6,
                            'labelName' => 'Password (Optional)',
                            'fieldType' => 'text',
                            'nameData' => 'password',
                            'placeholderData' => 'Password',
                            'isRequired' => false,
                        ])
                        @include('landlord.super-admin.partials.input-field', [
                            'colSize' => 6,
                            'labelName' => 'Password Confirmation (Optional)',
                            'fieldType' => 'text',
                            'nameData' => 'password_confirmation',
                            'placeholderData' => 'Password Confirmation',
                            'isRequired' => false,
                        ])


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="updateButton">@lang('file.Update')</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
