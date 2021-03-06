<?php

namespace PCN\Alarms;

use PCN\Alarms\Alarm;
use PCN\Helpers\OsUtility;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PaPlay extends Alarm
{
    protected $processor;

    public function __construct()
    {
        $this->processor = Process::fromShellCommandline(
            'paplay "$sound"'
        );
    }

    public function isAvailable(): bool
    {
        if (OsUtility::isUnixLike()) {
            $process = new Process(['paplay', '--version']);

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
