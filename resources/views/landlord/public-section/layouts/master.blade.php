

<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <!-- Metas -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="LionCoders" />
    <meta name="csrf-token" content="CmSeExxpkZmScDB9ArBZKMGKAyzPqnxEriplXWrS">

    @if(isset($generalSetting))
        <title>@yield('public-title') | {{ $generalSetting->site_title ? $generalSetting->site_title : null }}</title>
        <link rel="icon" type="image/png" href="{{asset('landlord/images/logo', $generalSetting->site_logo)}}" />
    @endif
    
    <!-- Meta -->
    @isset($seoSetting)
        <meta name="title" content="{{$seoSetting->meta_title}}" />
        <meta name="description" content="{{$seoSetting->meta_description}}" />
        <meta property="og:url" content="{{url()->full()}}" />
        <meta property="og:title" content="{{$seoSetting->og_title}}" />
        <meta property="og:description" content="{{$seoSetting->og_description}}" />
        <meta property="og:image" content="{{asset('landlord/images/seo-setting')}}/{{$seoSetting->og_image}}" />
    @endisset

    <!-- Bootstrap CSS -->
    <link href="{{asset('landlord/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="preload" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"></noscript>

    <!-- Plugins CSS -->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{asset('landlord/css/plugins.css')}}">
    <noscript><link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{asset('landlord/css/plugins.css')}}"></noscript>

    <!-- common style CSS -->
    <link id="switch-style" href="{{url('landlord/css/common-style-light.css')}}" rel="stylesheet">

    <!-- google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- @if(isset($general_setting->fb_pixel_script))
    {!!$general_setting->fb_pixel_script!!}
    @endif --}}

    @stack('css')

</head>

<body>

    @include('landlord.public-section.partials.header')

    @yield('public-content')

    @include('landlord.public-section.partials.footer')


    <!--Scroll to top starts-->
    <a href="#" id="scrolltotop"><i class="ti-arrow-up"></i></a>
    <!--Scroll to top ends-->
    <div class="body__overlay"></div>


    <!--Plugin js -->
    <script src="{{ asset('landlord/js/plugin.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script src="{{ asset('vendor/jquery/jquery-ui.min.js') }}"></script>

    <!-- Sweetalert2 -->
    {{-- <script src="{{ asset('landlord/js/sweetalert2@11.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main js -->
    <script src="{{ asset('landlord/js/main.js')}}"></script>
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

    @if(isset($general_setting->ga_script))
    {!!$general_setting->ga_script!!}
    @endif

    @if(isset($general_setting->chat_script))
    {!!$general_setting->chat_script!!}
    @endif

    @if(!env('USER_VERIFIED'))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-D0S4KHQ1D6"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-D0S4KHQ1D6');
    </script>
    @endif

    @if(env('PRODUCT_MODE')==='DEMO')
        <script>
            $('#light-theme').on('click',function(){
                var css = $('#switch-style').attr('href');
                css = css.replace('dark','light');
                $('#switch-style').attr("href", css);
            })

            $('#dark-theme').on('click',function(){
                var css = $('#switch-style').attr('href');
                css = css.replace('light','dark');
                $('#switch-style').attr("href", css);
            })
        </script>
    @endif

    @stack('scripts')
</body>
</html>

