<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PCN\Carrier;
use PCN\Notification;

$carrier = new Carrier();

$notification = new Notification([
    'title' => 'My First POPUP',
    'icon' => 'info', // 'info', 'warning', 'success', 'error' or any picture path
    'message' => 'This is the message of your notification',
    'sound' => 'beep' //'beep', 'error' or any supported sound file path
]);

$carrier->send($notification);
