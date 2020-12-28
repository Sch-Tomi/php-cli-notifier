<?php

namespace PCN\Alarms;

use PCN\Alarms\Alarm;
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
}
