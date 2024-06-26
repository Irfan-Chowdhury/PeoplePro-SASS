<div class="tab-pane fade" id="mailSetting" role="tabpanel" aria-labelledby="mail-setting">
    <div class="card">
    <h4 class="card-header p-3"><b>@lang('file.Mail Setting')</b></h4>
    <hr>
    <div class="card-body">
        <form id="mailSettingSubmit" enctype="multipart/form-data">
            @csrf

            <div class="row">
                @include('landlord.super-admin.partials.input-field',[
                    'colSize' => 6,
                    'labelName' => 'Mail Driver',
                    'fieldType' => 'text',
                    'nameData' => 'driver',
                    'placeholderData' => 'smtp',
                    'isRequired' => false,
                    'valueData'=> isset($mailSetting->driver) ? $mailSetting->driver : null
                ])
                @include('landlord.super-admin.partials.input-field',[
                    'colSize' => 6,
                    'labelName' => 'Mail Host',
                    'fieldType' => 'text',
                    'nameData' => 'host',
                    'placeholderData' => 'smtp.gmail.com',
                    'isRequired' => false,
                    'valueData'=> isset($mailSetting->host) ? $mailSetting->host : null
                ])
                @include('landlord.super-admin.partials.input-field',[
                    'colSize' => 6,
                    'labelName' => 'Mail Port',
                    'fieldType' => 'number',
                    'nameData' => 'port',
                    'placeholderData' => '587',
                    'isRequired' => false,
                    'valueData'=> isset($mailSetting->port) ? $mailSetting->port : null
                ])
                @include('landlord.super-admin.partials.input-field',[
                    'colSize' => 6,
                    'labelName' => 'Mail Address',
                    'fieldType' => 'text',
                    'nameData' => 'from_address',
                    'placeholderData' => 'admin@gmail.com',
                    'isRequired' => false,
                    'valueData'=> isset($mailSetting->from_address) ? $mailSetting->from_address : null
                ])
                @include('landlord.super-admin.partials.input-field',[
                    'colSize' => 6,
                    'labelName' => 'Mail From Name',
                    'fieldType' => 'text',
                    'nameData' => 'from_name',
                    'placeholderData' => 'Admin',
                    'isRequired' => false,
                    'valueData'=> isset($mailSetting->from_name) ? $mailSetting->from_name : null
                ])
                @include('landlord.super-admin.partials.input-field',[
                    'colSize' => 6,
                    'labelName' => 'User Name',
                    'fieldType' => 'text',
                    'nameData' => 'username',
                    'placeholderData' => 'admin@gmail.com',
                    'isRequired' => false,
                    'valueData'=> isset($mailSetting->username) ? $mailSetting->username : null
                ])
                @include('landlord.super-admin.partials.input-field',[
                    'colSize' => 6,
                    'labelName' => 'Password',
                    'fieldType' => 'text',
                    'nameData' => 'password',
                    'placeholderData' => '123456789',
                    'isRequired' => false,
                    'valueData'=> config('mail.password')
                ])

                <div class="col-md-6 form-group">
                    <label class="font-weight-bold">{{trans('file.Encryption')}}</label>
                    <select name="encryption" class="selectpicker form-control"
                        data-live-search="true" data-live-search-style="contains">
			            <option value="tls" {{ isset($mailSetting->encryption) && $mailSetting->encryption === 'tls' ? 'selected' : null }}>@lang('file.TLS')</option>
                        <option value="ssl" {{ isset($mailSetting->encryption) && $mailSetting->encryption === 'ssl' ? 'selected' : null }}>@lang('file.SSL')</option>
                    </select>
                </div>

                <div class="col-md-6 form-group">
                    <div class="form-check mt-2">
                        <input type="checkbox" name="is_active"  {{ config('mail.is_active')==1 ? "checked" : '' }} value="1" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label font-weight-bold" for="exampleCheck1">Active</label>
                    </div>
                </div>
                
                <br>
                <div class="col-md-12 form-group">
                    <span class="text-danger"><i>(To confirm, I suggest you to test on Forget Password.)</i></span>
		</div>
		
            </div>
            <div class="form-group row">
                <button type="submit" id="mailButton" class="my-3 btn btn-primary btn-block">@lang('file.Submit')</button>
            </div>
        </form>
    </div>
</div>
</div>
