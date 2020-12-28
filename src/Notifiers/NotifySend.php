<?php

namespace PCN\Notifiers;

use Symfony\Component\Process\Process;

use PCN\Notification;

class NotifySend extends NotifierBase
{
    protected $processor;
    protected bool $canPlaySound;


    public function __construct()
    {
        parent::__construct(
            false,
            Process::fromShellCommandline(
                'notify-send -u normal -i "$icon" "$title" "$message"'
            )
        );
    }
}
