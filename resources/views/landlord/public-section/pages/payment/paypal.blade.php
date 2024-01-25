@extends('landlord.public-section.layouts.master')
@section('public-title', 'Paypal')
@section('public-content')

<div class="row">
    <div class="col-12">
        <h1 class="page-title h2 text-center uppercase mt-1 mb-5">@lang('file.Paypal')
            <small>
                ({{ number_format((float)$totalAmount, 2, '.', '') }})
            </small>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid" id="errorMessage"></div>

                <form id="paypalPaymentForm">
                    @csrf
                    <input type="hidden" name="tenantRequestData" value="{{ $tenantRequestData }}">
                    <input type="hidden" name="total_amount" value="{{ $totalAmount }}">

                    <div id="paypal-button-container"></div>

                    <div class="mt-3 d-grid gap-2 mx-auto">
                        <a href="{{ route('landingPage.index') }}" id="payCancelBtn" class="btn btn-outline-danger">Cancel</a>
                    </div>

                    <div class="mt-3 d-grid gap-2 mx-auto d-none" id="processingButton">
                        <button class="btn btn-outline-success">Please Wait, Processing...</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection

@push('scripts')

@if (env('PAYPAL_MODE')==='sandbox')
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}&currency={{env('PAYPAL_CURRENCY')}}" data-namespace="paypal_sdk"></script>
@elseif (env('PAYPAL_MODE')==='live')
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_LIVE_CLIENT_ID')}}&currency={{env('PAYPAL_CURRENCY')}}" data-namespace="paypal_sdk"></script>
@endif

<script type="text/javascript">
    let tenant = @json($tenantRequestData);
    let centralDomain = @json(env('CENTRAL_DOMAIN'));
    let data = JSON.parse(tenant);
    let tenantId = data.tenant;
    let domain = tenantId +'.'+ centralDomain;

    let targetURL = "{{ url('/payment/paypal/pay/process')}}";
    let redirectURL = "{{ url('/payment-success')}}" + '/' + domain;
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    paypal_sdk.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: $('input[name="total_amount"]').val(),
                        currency_code: "{{env('PAYPAL_CURRENCY')}}",
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                if (details.status=="COMPLETED") {
                    $("#paypal-button-container").hide();
                    $("#payCancelBtn").hide();
                    $("#processingButton").removeClass('d-none');
                    $.post({
                        url: targetURL,
                        data: $('#paypalPaymentForm').serialize(),
                        error: function(response) {
                            let htmlContent = prepareMessage(response);
                            displayErrorMessage(htmlContent);
                        },
                        success: function (response) {
                            displaySuccessMessage(response.alertMsg);
                            window.location.href = redirectURL;
                        }
                    });
                }
            });
        }
    }).render('#paypal-button-container');

</script>
<script type="text/javascript" src="{{ asset('js/landlord/common-js/alertMessages.js') }}"></script>

@endpush

