@extends('landlord.super-admin.layouts.master')
@push('custom-css')
<style>
    .count-title .icon {
        font-size: 36px;
        margin-right: 20px
    }
    .count-title .count-number {
        font-size: 22px;
        font-weight: 400
    }
    .count-title .count-number span {
        color: #999;
        font-size: 16px;
    }
</style>
@endpush
@section('landlord-content')

        <!-- Alert Section for version upgrade-->
        @if (env('PRODUCT_MODE')==='CLIENT')
        <div id="alertSection" class="{{ $alertVersionUpgradeEnable==true ? null : 'd-none' }} alert alert-primary alert-dismissible fade show" role="alert">
            <p id="announce" class="{{ $alertVersionUpgradeEnable==true ? null : 'd-none' }}"><strong>Announce !!!</strong> A new version {{config('auto_update.VERSION')}} <span id="newVersionNo"></span> has been released. Please <i><b><a href="{{route('new-release')}}">Click here</a></b></i> to check upgrade details.</p>
            <button type="button" id="closeButtonUpgrade" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <!-- Alert Section for Bug update-->
        {{-- <div id="alertBugSection" class=" {{ $alertBugEnable==true ? null : 'd-none' }} alert alert-primary alert-dismissible fade show" style="background-color: rgb(248,215,218)" role="alert">
            <p id="alertBug" class=" {{ $alertBugEnable==true ? null : 'd-none' }} " style="color: rgb(126,44,52)"><strong>Alert !!!</strong> Minor bug fixed in version {{env('VERSION')}}. Please <i><b><a href="{{route('bug-update-page')}}">Click here</a></b></i> to update the system.</p>
            <button type="button" style="color: rgb(126,44,52)" id="closeButtonBugUpdate" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> --}}

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <div class="wrapper count-title">
                        <div class="icon"><i class="dripicons-graph-bar" style="color: #733686"></i></div>
                        <div>
                            <div class="count-number"><span>{{$generalSetting->currency_code}}</span> {{number_format($subscriptionValue, 2)}}</div>
                            <div class="name"><strong style="color: #733686">{{ __('file.Subscription value') }}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="wrapper count-title">
                        <div class="icon"><i class="dripicons-card" style="color: #5fc64a"></i></div>
                        <div>
                            <div class="count-number"><span>{{$generalSetting->currency_code}}</span> {{number_format($receivedAmount, 2)}}</div>
                            <div class="name"><strong style="color: #5fc64a">{{ __('file.Received Amount') }}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="wrapper count-title">
                        <div class="icon"><i class="dripicons-user" style="color: #00c689"></i></div>
                        <div>
                            <div class="count-number">{{$totalTenantCount}} ({{$totalActiveTenantCount}} <span>{{ __('file.Active') }}</span>)</div>
                            <div class="name"><strong style="color: #00c689">{{ __('file.Total Clients') }}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="wrapper count-title">
                        <div class="icon"><i class="dripicons-archive" style="color: #ff8952"></i></div>
                        <div>
                            <div class="count-number">{{$totalPackageCount}}</div>
                            <div class="name"><strong style="color: #ff8952">{{ __('file.Packages') }}</strong></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{trans('file.Send message to customers')}}</h4>
                        </div>
                        <div class="card-body">
                            <label>Select customer</label>
                            {{-- <!-- <select name="tenants" multiple>
                                @foreach($tenants as $tenant)
                                <option value="{{$tenant->id}}">{{$tenant->id}}</option>
                                @endforeach
                            </select> --> --}}
                            <p>This feature is coming soon...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection





