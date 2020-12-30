<?php

namespace PCN;

use PCN\Notifiers\NotifierInterface;
use PCN\Notification;

use PCN\Alarms\PaPlay;
use PCN\Alarms\PowerShellAlarm;
use PCN\Notifiers\NotifySend;
use PCN\Notifiers\BurntToast;
use PCN\Notifiers\WindowsForm;
use PCN\Notifiers\Zenity;

class Carrier
{
    private array $notifiers;
    private array $alarms;

    private NotifierInterface $selectedNotifier;
    private $selectedAlarm;

    public function __construct()
    {
        $this->registerNotifiers();
        $this->registerAlarms();

        $this->selectNotifier();
        $this->selectAlarm();
    }

    private function registerNotifiers(): void
    {
        $this->notifiers = [
            new NotifySend,
            new Zenity,
            new BurntToast,
            new WindowsForm,
        ];
    }

    private function registerAlarms(): void
    {
        $this->alarms = [
            new PaPlay,
            new PowerShellAlarm,
        ];
    }

    private function selectNotifier(): void
    {
        foreach ($this->notifiers as $notifier) {
            if ($notifier->isAvailable()) {
                $this->selectedNotifier = $notifier;
                break;
            }
        }
    }

    private function selectAlarm(): void
    {
        foreach ($this->alarms as $alarm) {
            if ($alarm->isAvailable()) {
                $this->selectedAlarm = $alarm;
                break;
            }
        }
    }

    public function send(Notification $notification): void
    {
        $this->selectedNotifier->show($notification);

        if ($this->selectedNotifier->canNotPlaySound() && $this->selectedAlarm) {
            $this->selectedAlarm->play($notification);
        }
    }

    public function create(array $config)
    {
        $this->send(new Notification($config));
    }
}
