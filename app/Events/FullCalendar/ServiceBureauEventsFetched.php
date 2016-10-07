<?php

namespace App\Events\FullCalendar;

use App\Events\DashboardEvent;

class ServiceBureauEventsFetched extends DashboardEvent
{
    /** @var array */
    public $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }
}
