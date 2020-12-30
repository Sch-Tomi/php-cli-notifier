<?php

namespace PCN\Notifiers;

use PCN\Helpers\OsUtility;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class BurntToast extends NotifierBase
{
    protected $processor;
    protected bool $canPlaySound;


    public function __construct()
    {
        parent::__construct(
            false,
            Process::fromShellCommandline(
                'powershell -command "New-BurntToastNotification -Silent -AppLogo "${:icon}" -Text \'"${:title}"\', \'"${:message}"\'"'
            )
        );
    }

    public function isAvailable(): bool
    {
        if (OsUtility::isWindows()) {
            $process = new Process(['powershell', '-command' ,'"Get-Module -ListAvailable -Name BurntToast"']);
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
