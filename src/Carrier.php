<?php

namespace PCN;

use PCN\Notifiers\NotifierInterface;
use PCN\Notification;

use PCN\Alarms\PaPlay;

use PCN\Notifiers\NotifySend;
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
        ];
    }

    private function registerAlarms(): void
    {
        $this->alarms = [
            new PaPlay,
        ];
    }

    private function selectNotifier(): void
    {
        $this->selectedNotifier = $this->notifiers[1];
    }

    private function selectAlarm(): void
    {
        $this->selectedAlarm = $this->alarms[0];
    }

    public function send(Notification $notification):void
    {
        $this->selectedNotifier->show($notification);

        if($this->selectedNotifier->canNotPlaySound()){
            $this->selectedAlarm->play($notification);
        }
    }

    public function create(array $config){
        $this->send(new Notification($config));
    }
}
