<?php

namespace App\Http\Controllers\Landlord\API;

use App\Http\Controllers\Controller;
use App\Models\Landlord\Package;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return [
            'Name' => 'Irfan',
            'Company' => 'LionConders',
        ];
    }
}
