<?php

namespace PCN\Notifiers;

use PCN\Helpers\OsUtility;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


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

    public function isAvailable(): bool
    {
        if (OsUtility::isUnixLike()) {
            $process = new Process(['notify-send', '--version']);

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
