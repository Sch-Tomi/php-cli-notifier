<?php

namespace PCN\Notifiers;

use PCN\Notification;
use Symfony\Component\Process\Process;

class Zenity extends NotifierBase
{
    protected $processor;
    protected bool $canPlaySound;


    public function __construct()
    {
        parent::__construct(
            false,
            Process::fromShellCommandline(
                'zenity --notification --text="${:text}" --window-icon="${:icon}"'
            )
        );
    }

    public function show(Notification $notification): void
    {
        $baseParams = $notification->toArray();
        $baseParams['text'] = $baseParams['title'] . "\n\n" . $baseParams['message'];

        $this->processor->run(null, $baseParams);
    }
}
