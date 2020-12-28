<?php

namespace PCN\Alarms;

use PCN\Notification;

abstract class Alarm
{
    protected $processor;

    public function play(Notification $notification): void
    {
        $this->processor->run(null, $notification->toArray());
    }
}
