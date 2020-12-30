<?php

namespace PCN\Alarms;

use PCN\Alarms\Alarm;
use PCN\Helpers\OsUtility;
use PCN\Notification;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PowerShellAlarm extends Alarm
{
    protected $processor;

    public function __construct()
    {
        $this->processor = Process::fromShellCommandline(
            'powershell -Command "& \'"${:script}"\' \'"${:sound}"\' "'
        );
    }

    public function play(Notification $notification): void
    {
        $baseParams = $notification->toArray();
        $baseParams['script'] = realpath(dirname(__FILE__) . '/../assets/powerShellScripts/alarm.ps1');

        $this->processor->run(null, $baseParams);
    }

    public function isAvailable(): bool
    {
        if (OsUtility::isWindows()) {
            $process = new Process(['powershell', '-help']);
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
