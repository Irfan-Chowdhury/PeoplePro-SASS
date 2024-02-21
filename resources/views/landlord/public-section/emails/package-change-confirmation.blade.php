<div>
    Dear {{ $name }},
    <br>

    Your previous package <b>{{ $previousPackage }}</b> has been changed into the <b>{{ $newPackage }} package</b>. Please check now.

    <br><br>
    Thanks and Regards,
    <br>
    {{$generalSetting->footer ?? "no title"}}
</div>
