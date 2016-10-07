<?php

namespace App\Events\GoogleCalendar;

use App\Events\MonitorEvent;

class ServiceBureauEventsFetched extends MonitorEvent
{
    /** @var array */
    public $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }
}
