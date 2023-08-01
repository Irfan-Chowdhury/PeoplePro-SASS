<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver',
        'host',
        'port',
        'from_address',
        'from_name',
        'username',
        'password',
        'encryption'
    ];
}
