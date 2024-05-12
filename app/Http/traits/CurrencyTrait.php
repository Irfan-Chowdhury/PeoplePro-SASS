<?php
namespace App\Http\traits;

use App\Models\GeneralSetting;

trait CurrencyTrait{

    public function displayWithCurrency(null|int|float $amount=0) : string
    {
        $totalAmount = number_format((float)$amount, 2, '.', '');
        
        $generalSetting = GeneralSetting::latest()->first();

        if($generalSetting->currency_format=='suffix') {
            return  $totalAmount.' '.$generalSetting->currency;
        }else {
            return $generalSetting->currency.' '. $totalAmount;
        }
    }
}
