<?php

namespace PCN\Alarms;

use PCN\Notification;

interface AlarmInterface
{
    public function play(Notification $notification): void;
    public function isAvailable(): bool;
}
