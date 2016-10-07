<?php

namespace App\Events\GoogleTasks;

use App\Events\DashboardEvent;

class DiversifiedTasksFetched extends DashboardEvent
{
    /** @var array */
    public $tasks;

    public function __construct(array $tasks)
    {
        $this->tasks = $tasks;
    }
}
