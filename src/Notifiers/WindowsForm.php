<?php

namespace PCN\Notifiers;

use PCN\Helpers\OsUtility;
use PCN\Notification;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class WindowsForm extends NotifierBase
{
    protected $processor;
    protected bool $canPlaySound;


    public function __construct()
    {
        parent::__construct(
            true,
            Process::fromShellCommandline(
                'powershell -Command "& \'"${:script}"\' \'"${:title}"\' \'"${:message}"\' "'
            )
        );
    }

    public function show(Notification $notification): void
    {
        $baseParams = $notification->toArray();
        $baseParams['script'] = realpath(dirname(__FILE__) . '/../assets/powerShellScripts/toast.ps1');

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
