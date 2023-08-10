{{-- @php $general_settings = DB::table('general_settings')->latest()->first(); @endphp --}}

<!-- navbar-->
<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="dripicons-menu"> </i></a>
                <span class="brand-big" id="site_logo_main">
                    {{-- @if($general_settings->site_logo) --}}
						{{-- <img src="{{asset('/images/logo/'.$general_settings->site_logo)}}" width="140" height="70"> --}}
                        <img src="{{asset('/images/logo/logo.png')}}" width="140" height="70">
                        &nbsp; &nbsp;
                    {{-- @endif --}}
                </span>


                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <li class="nav-item">
                        <a class="dropdown-header-name" style="padding-right: 10px" href="" data-toggle="tooltip" title="Clear all cache with refresh"><i class="fa fa-refresh"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-header-name" style="padding-right: 10px" href="{{ route('landingPage.index') }}" target="_blank" title="View Website"><i class="dripicons-preview"></i></a>
                    </li>
                    <li class="nav-item"><a id="btnFullscreen" data-toggle="tooltip"
                                            title="{{__('Full Screen')}}"><i class="dripicons-expand"></i></a></li>
                    <li class="nav-item">
                        <a rel="nofollow" id="notify-btn" href="#" class="nav-link dropdown-item" data-toggle="tooltip"
                           title="{{__('Notifications')}}">
                            <i class="dripicons-bell"></i>
                            {{-- @if(auth()->user()->unreadNotifications->count())
                                <span class="badge badge-danger">
                                    {{auth()->user()->unreadNotifications->count()}}
                                </span>
                            @endif --}}
                            <span class="badge badge-danger">
                                5
                            </span>
                        </a>
                        <ul class="right-sidebar">
                            <li class="header">
                                <span class="pull-right"><a href="">{{__('Clear All')}}</a></span>
                                <span class="pull-left"><a href="">{{__('See All')}}</a></span>
                            </li>
                            {{-- @foreach(auth()->user()->notifications as $notification)
                                <li><a class="unread-notification"
                                       href={{$notification->data['link']}}>{{$notification->data['data']}}</a></li>
                            @endforeach --}}
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a rel="nofollow" href="#" class="nav-link dropdown-item" data-toggle="tooltip"
                           title="{{__('Language')}}">
                            <i class="dripicons-web">
                                {{-- {{ __(strtoupper('en')) }} --}}
                                {{ Session::has('TempSuperAdminLocale') ? strtoupper(Session::get('TempSuperAdminLocale')) : strtoupper(Session::has('DefaultSuperAdminLocale')) }}

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

                {{-- @if (Auth::user()->role_users_id==1) --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank" data-toggle="tooltip"
                           title="{{__('Documentation')}}">
                            <i class="dripicons-information"></i>
                        </a>
                    </li>
                {{-- @endif --}}

                    <li class="nav-item">
                        <a rel="nofollow" href="#" class="nav-link dropdown-item">
                            {{-- <img class="profile-photo sm mr-1" src="{{ asset('uploads/profile_photos/avatar.jpg')}}"> --}}

                            {{-- @if(!empty(auth()->user()->profile_photo))
                                <img class="profile-photo sm mr-1"
                                     src="{{ asset('uploads/profile_photos/')}}/{{auth()->user()->profile_photo}}">
                            @else
                                <img class="profile-photo sm mr-1"
                                     src="{{ asset('uploads/profile_photos/avatar.jpg')}}">
                            @endif
                            <span> {{auth()->user()->username}}</span> --}}
                            <img class="profile-photo sm mr-1" src="{{ asset('uploads/profile_photos/avatar.jpg')}}">
                             <span> Admin</span>
                        </a>
                        <ul class="right-sidebar">
                            <li>
                                <a href="#">
                                    <i class="dripicons-user"></i>
                                    {{trans('file.Profile')}}
                                </a>
                            </li>
                            {{-- @if(auth()->user()->role_users_id == 1) --}}
                                <li id="empty_database">
                                    <a href="#">
                                        <i class="dripicons-stack"></i>
                                        {{__('Empty Database')}}
                                    </a>
                                </li>
                            {{-- @endif --}}
                            {{-- @if(auth()->user()->role_users_id == 1) --}}
                                <li id="export_database">
                                    <a href="#">
                                        <i class="dripicons-cloud-download"></i>
                                        {{__('Export Database')}}
                                    </a>
                                </li>
                            {{-- @endif --}}
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
    {{-- @include('shared.flash_message') --}}
</header>
