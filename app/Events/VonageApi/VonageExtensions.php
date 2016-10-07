<?php

namespace App\Events\VonageApi;

use App\Events\DashboardEvent;

class VonageExtensions extends DashboardEvent
{
    /** @var array */
    public $extensionInfo;

    public function __construct(array $extensionInfo)
    {
        $this->extensionInfo = $extensionInfo;
        //dd($this->extensionInfo);
    }
}
