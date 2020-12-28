<?php

namespace PCN\Alarms;

use PCN\Alarms\Alarm;

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
        $process = new Process(['paplay', '--version']);

        try {
            $process->mustRun();

            return true;
        } catch (ProcessFailedException $exception) {
            return false;
        }
    }
}
