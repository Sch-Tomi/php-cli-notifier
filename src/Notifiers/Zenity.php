<?php

namespace PCN\Notifiers;

use PCN\Helpers\OsUtility;
use PCN\Notification;

use Symfony\Component\Process\Exception\ProcessFailedException;
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

    public function isAvailable(): bool
    {
        if (OsUtility::isUnixLike()) {

            $process = new Process(['zenity', '--version']);

            try {
                $process->mustRun();

                return true;
            } catch (ProcessFailedException $exception) {
                return false;
            }
        }

        return false;
    }
}
