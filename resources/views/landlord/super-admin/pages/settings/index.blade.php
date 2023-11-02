@extends('landlord.super-admin.layouts.master')
@section('landlord-content')


    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-3">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="general-setting" data-toggle="list" href="#generalSetting" role="tab" aria-controls="home">@lang('file.General Setting')</a>
                    <a class="list-group-item list-group-item-action" id="payment-setting" data-toggle="list" href="#paymentSetting" role="tab" aria-controls="settings">@lang('file.Payment Setting')</a>
                    <a class="list-group-item list-group-item-action" id="mail-setting" data-toggle="list" href="#mailSetting" role="tab" aria-controls="settings">@lang('file.Mail Setting')</a>
                    <a class="list-group-item list-group-item-action" id="analytics-setting" data-toggle="list" href="#analyticsSetting" role="tab" aria-controls="settings">@lang('file.Analytics Setting')</a>
                    <a class="list-group-item list-group-item-action" id="seo-setting" data-toggle="list" href="#seoSetting" role="tab" aria-controls="settings">@lang('file.SEO Setting')</a>
                </div>
            </div>
            <div class="col-9">
              <div class="tab-content" id="nav-tabContent">

                @include('landlord.super-admin.pages.settings.general')

                @include('landlord.super-admin.pages.settings.payment_setting')

                @include('landlord.super-admin.pages.settings.mail_setting')

                @include('landlord.super-admin.pages.settings.analytic_setting')

                @include('landlord.super-admin.pages.settings.seo_setting')


                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">Profile</div>
                <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">Messages</div>

              </div>
            </div>
          </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        (function($) {
            "use strict";

            let generalSettingURL = "{{ route('setting.general.manage') }}";
            let paymentSettingURL = "{{ route('setting.payment.manage') }}";
            let mailSettingURL = "{{ route('setting.mail.manage') }}";
            let analyticSettingURL = "{{ route('setting.analytic.manage') }}";
            let seoSettingURL = "{{ route('setting.seo.manage') }}";

            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#generalSettingSubmit").on("submit", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    generateSetting('generalButton', generalSettingURL, formData);
                });
                $("#paymentSettingSubmit").on("submit", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    generateSetting('paymentButton', paymentSettingURL, formData);
                });
                $("#mailSettingSubmit").on("submit", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    generateSetting('mailButton', mailSettingURL, formData);
                });
                $("#analyticSettingSubmit").on("submit", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    generateSetting('analyticButton', analyticSettingURL, formData);
                });
                $("#seoSettingSubmit").on("submit", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    generateSetting('seoButton', seoSettingURL, formData);
                });
            });

            let generateSetting = (submitButtonName, settingURL, formData) => {
                $(`#${submitButtonName}`).text('Submitting...');
                $.post({
                    url: settingURL,
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    error: function(response) {
                        console.log(response);
                        let htmlContent = prepareMessage(response);
                        displayErrorMessage(htmlContent);
                        $(`#${submitButtonName}`).text('Submit');
                    },
                    success: function(response) {
                        console.log(response);
                        displaySuccessMessage(response.success);
                        $(`#${submitButtonName}`).text('Submit');
                    }
                });
            }
        })(jQuery);
    </script>

    <script type="text/javascript" src="{{ asset('js/landlord/common-js/alertMessages.js') }}"></script>
@endpush
