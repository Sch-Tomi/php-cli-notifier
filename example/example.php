<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PCN\Carrier;
use PCN\Notification;

$carrier = new Carrier();

$notification = new Notification([
    'title' => 'My First POPUP',
    'icon' => 'info',
    'message' => 'This is the body of your notification',
    'sound' => 'beep'
]);

$carrier->send($notification);
