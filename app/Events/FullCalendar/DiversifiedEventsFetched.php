<?php

namespace App\Events\FullCalendar;

use App\Events\DashboardEvent;

class DiversifiedEventsFetched extends DashboardEvent
{
    /** @var array */
    public $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }
}
