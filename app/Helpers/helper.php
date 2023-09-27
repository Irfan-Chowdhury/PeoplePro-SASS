<?php

use App\Models\MailSetting;
use Illuminate\Support\Facades\Crypt;

function tenantPath(){
    return 'tenants/'.tenant('id');
}

// function tenantSetMailInfo()
// {
//     $mailSetting = MailSetting::latest()->first();
//     if ($mailSetting) {
//         config()->set('mail.driver', $mailSetting->driver);
//         config()->set('mail.host', $mailSetting->host);
//         config()->set('mail.port', $mailSetting->port);
//         config()->set('mail.from.address', $mailSetting->from_address);
//         config()->set('mail.from.name', $mailSetting->from_name);
//         config()->set('mail.username', $mailSetting->username);
//         config()->set('mail.password', Crypt::decrypt($mailSetting->password));
//         config()->set('mail.encryption', $mailSetting->encryption);
//     }
// }



?>
