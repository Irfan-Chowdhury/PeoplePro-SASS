
@php $general_settings = DB::table('general_settings')->latest()->first(); @endphp

<footer class="main-footer">
    <div class="container-fluid">
        <p>&copy; {{$general_settings->site_title ?? "no title"}} || {{ __('Developed by')}}
            <a href={{$general_settings->footer_link}} class="external">{{$general_settings->footer}}</a> || Version - 1.1.2
            {{-- {{ config('app.version') }} --}}
    </div>
</footer>
