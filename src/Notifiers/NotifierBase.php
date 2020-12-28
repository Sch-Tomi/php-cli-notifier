<?php

namespace PCN\Notifiers;

use PCN\Notification;

abstract class NotifierBase implements NotifierInterface
{
    protected bool $canPlaySound;
    protected $processor;

    public function __construct(bool $canPlaySound = false, $processor)
    {
        $this->canPlaySound = $canPlaySound;
        $this->processor = $processor;
    }

    public function canPlaySound(): bool
    {
        return $this->canPlaySound;
    }

    public function canNotPlaySound(): bool
    {
        return !$this->canPlaySound;
    }

    public function show(Notification $notification): void
    {
        $this->processor->run(null, $notification->toArray());
    }
}
