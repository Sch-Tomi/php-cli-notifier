<?php

namespace PCN\Alarms;

use PCN\Alarms\AlarmInterface;
use PCN\Notification;

abstract class Alarm implements AlarmInterface
{
    protected $processor;

    public function play(Notification $notification): void
    {
        $this->processor->run(null, $notification->toArray());
    }
}
