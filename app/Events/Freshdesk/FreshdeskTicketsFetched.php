<?php

namespace App\Events\Freshdesk;

use App\Events\DashboardEvent;

class FreshdeskTicketsFetched extends DashboardEvent
{
    /** @var array */
    public $ticketInfo;

    public function __construct(array $ticketInfo)
    {
        $this->ticketInfo = $ticketInfo;
    }
}
