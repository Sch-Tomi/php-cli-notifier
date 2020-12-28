<?php

namespace PCN\Notifiers;

use PCN\Notification;

interface NotifierInterface
{
    public function show(Notification $notification): void;
    public function canPlaySound(): bool;
    public function canNotPlaySound(): bool;
    public function isAvailable(): bool;
}
