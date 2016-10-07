<?php

namespace App\Events\GitHub;

use App\Events\DashboardEvent;

class CommitFetched extends DashboardEvent
{
    /** @var array */
    public $commitInfo;

    public function __construct(array $commitInfo)
    {
        $this->commitInfo = $commitInfo;
    }
}
