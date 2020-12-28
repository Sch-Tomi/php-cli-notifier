<?php

use PCN\Notification;

uses()->group('Notification');

test('setTitle and getTitle', function () {
    $notification = new Notification();
    $notification->setTitle('example');

    expect($notification->getTitle())->toBeString()->toEqual('example');
});

test('setMessage and getMessage', function () {
    $notification = new Notification();
    $notification->setMessage('example');

    expect($notification->getMessage())->toBeString()->toEqual('example');
});

test('setIcon and getIcon', function () {
    $notification = new Notification();
    $notification->setIcon('example');

    expect($notification->getIcon())->toBeString()->toEqual('example');
});

test('setSound and getSound', function () {
    $notification = new Notification();
    $notification->setSound('example');

    expect($notification->getSound())->toBeString()->toEqual('example');
});

test('construct can set props', function () {
    $notification = new Notification([
        'title'   => 'example title',
        'message' => 'example message',
        'icon'    => 'example icon',
        'sound'   => 'example sound',
    ]);

    expect($notification->getTitle())->toBeString()->toEqual('example title');
    expect($notification->getMessage())->toBeString()->toEqual('example message');
    expect($notification->getIcon())->toBeString()->toEqual('example icon');
    expect($notification->getSound())->toBeString()->toEqual('example sound');
});
