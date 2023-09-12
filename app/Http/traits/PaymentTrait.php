<?php

namespace App\Http\traits;

trait PaymentTrait {

    public function paymentMethods() : array
    {
        return [
            // (object)[
            //     'title' => 'Cash On Delivery',
            //     'payment_method' => 'cash_on_delivery',
            // ],
            (object)[
                'title' => 'Stripe',
                'payment_method' => 'stripe',
            ],
            (object)[
                'title' => 'Paypal',
                'payment_method' => 'paypal',
            ],
            // (object)[
            //     'title' => 'Other',
            //     'payment_method' => 'other',
            // ]
        ];
    }
}
