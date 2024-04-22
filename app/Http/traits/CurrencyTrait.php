<?php
namespace App\Http\traits;

use App\Models\GeneralSetting;

trait CurrencyTrait{

    public function displayWithCurrency(int|float $amount) : string
    {
        $generalSetting = GeneralSetting::latest()->first();

        if($generalSetting->currency_format=='suffix') {
            return  $amount.' '.$generalSetting->currency;
        }else {
            return $generalSetting->currency.' '. $amount;
        }
    }
}
