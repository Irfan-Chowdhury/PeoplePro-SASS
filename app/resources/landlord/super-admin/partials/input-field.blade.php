<div class="col-md-{{ $colSize }}">
    <div class="form-group">
        @if ($fieldType !== 'checkbox')
            <label class="font-weight-bold">{{trans("file.$labelName")}} @if($isRequired)<span class="text-danger">*</span> @endif </label>
        @endif

        @switch($fieldType)
            @case('text')
                <input {{ $isRequired ? 'required':'' }} type="text" name="{{ $nameData }}" id="{{ isset($idData) ? $idData : null }}" @if(isset($valueData)) value="{{ $valueData }}" @else placeholder="{{ $placeholderData }}" @endif class="form-control">
                @break
            @case('textarea')
                <textarea  {{ $isRequired ? 'required':'' }} name="{{ $nameData }}" id="{{ isset($idData) ? $idData : null }}" @if(isset($placeholderData)) placeholder="{{ $placeholderData }}" @endif class="form-control ckeditor" rows="4"> @if(isset($valueData)) {{ $valueData }} @endif </textarea>
                @break
            @case('checkbox')
                <input {{ $isRequired ? 'required':'' }} type="checkbox"  name="{{ $nameData }}" id="{{ isset($idData) ? $idData : null }}" @if(isset($valueData)) value="{{ $valueData }}" @endif> &nbsp;
                <label class="font-weight-bold">{{trans("file.$labelName")}}</label>
                @break
            @default
        @endswitch
    </div>
</div>