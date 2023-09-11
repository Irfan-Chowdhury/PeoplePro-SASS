<?php

namespace App\Services;

use App\Payment\StripePayment;

class PaymentService
{
    public function initialize($payment_type)
    {
        switch ($payment_type) {
            case 'stripe':
                return new StripePayment();
            default:
                break;
        }
    }
}
?>
