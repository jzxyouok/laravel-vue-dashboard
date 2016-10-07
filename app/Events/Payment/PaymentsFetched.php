<?php

namespace App\Events\Payment;

use App\Events\DashboardEvent;

class PaymentsFetched extends DashboardEvent
{
    /** @var array */
    public $paymentInfo;

    public function __construct(array $paymentInfo)
    {
        $this->paymentInfo = $paymentInfo;
    }
}
