
<!-- navbar-->
<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="dripicons-menu"> </i></a>
                <span class="brand-big" id="site_logo_main">
                    @if($generalSetting->site_logo)
						<img src="{{asset('landlord/images/logo/'.$generalSetting->site_logo)}}" width="140" height="70">
                        &nbsp; &nbsp;
                    @endif
                </span>


                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <li class="nav-item">
                        <a class="dropdown-header-name" style="padding-right: 10px" href="{{ url('/optimize') }}" data-toggle="tooltip" title="Clear all cache with refresh"><i class="fa fa-refresh"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-header-name" style="padding-right: 10px" href="{{ route('landingPage.index') }}" target="_blank" title="View Website"><i class="dripicons-preview"></i></a>
                    </li>
                    <li class="nav-item"><a id="btnFullscreen" data-toggle="tooltip" title="{{__('Full Screen')}}"><i class="dripicons-expand"></i></a></li>
                    <li class="nav-item">
                        <a rel="nofollow" href="#" class="nav-link dropdown-item" data-toggle="tooltip"
                           title="{{__('Language')}}">
                            <i class="dripicons-web">
                                {{ Session::has('TempSuperAdminLocale') ? strtoupper(Session::get('TempSuperAdminLocale')) : strtoupper(Session::get('DefaultSuperAdminLocale')) }}
                            </i>
                        </a>
                        <ul class="right-sidebar">
                            @if(config('database.connections.peopleprosaas_landlord'))
                                @foreach($languages as $lang)
                                    <li>
                                        <a href="{{route('lang.switch',$lang->locale)}}">{{$lang->name.' ('.$lang->locale.')'}}</a>
                                    </li>
                                @endforeach
                            @else
                                @foreach($languages as $lang)
                                    <li>
                                        <a href="{{route('lang.switch',$lang)}}">{{$lang}}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://peopleprohrmsaas.com/central-documentation" target="_blank" data-toggle="tooltip"
                           title="{{__('Documentation')}}">
                            <i class="dripicons-information"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a rel="nofollow" id="notify-btn" href="#" class="nav-link dropdown-item" data-toggle="tooltip"
                           title="{{__('Notifications')}}">
                            <i class="dripicons-bell"></i>
                            @if(auth()->user()->unreadNotifications->count())
                                <span class="badge badge-danger">
                                    {{auth()->user()->unreadNotifications->count()}}
                                </span>
                            @endif
                        </a>
                        <ul class="right-sidebar">
                            <li class="header">
                                <span class="pull-right"><a href="{{route('clearAllNotification')}}">{{__('Clear All')}}</a></span>
                                <span class="pull-left"><a href="{{route('seeAllNotification')}}">{{__('See All')}}</a></span>
                            </li>
                            @foreach(auth()->user()->notifications as $notification)
                                <li><a class="unread-notification"
                                       href={{$notification->data['link']}}>{{$notification->data['data']}}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a rel="nofollow" href="#" class="nav-link dropdown-item">
                            @if(isset(auth()->user()->profile_photo))
                                <img class="profile-photo sm mr-1" src="{{asset('landlord/images/profile/'.auth()->user()->profile_photo)}}">
                            @else
                                <img class="profile-photo sm mr-1" src="{{ asset('uploads/profile_photos/avatar.jpg')}}"><span> Admin</span>
                            @endif
                        </a>
                        <ul class="right-sidebar">
                            <li>
                                <a href="{{ route('admin.profile') }}">
                                    <i class="dripicons-user"></i>
                                    {{trans('file.Profile')}}
                                </a>
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('landlord.logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-link" type="submit"><i class="dripicons-exit"></i> {{trans('file.logout')}}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
<script type="text/javascript">
    (function ($) {

        "use strict";

        $('#notify-btn').on('click', function (event) {
            event.preventDefault();
            $('.badge.badge-danger').empty();
            $.ajax({
                url: '{{route('markAsReadNotification')}}',
                dataType: "json",
                success: function (result) {
                },
            });
        })

    })(jQuery);
</script>

@endpush
