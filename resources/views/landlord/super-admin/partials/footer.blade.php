<footer class="main-footer">
    <div class="container-fluid">
        <p>&copy; {{$generalSetting->footer ?? "no title"}} || {{ __('Developed by')}}
            <a href="{{ $generalSetting->footer_link }}" class="external"> {{ $generalSetting->developed_by }} </a> || Version - 1.2.1 <!-- config('app.version') }} -->
        </p>
    </div>
</footer>
