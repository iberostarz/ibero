<?php

use App\Controllers\HomeController;
use App\Controllers\BeachController;
use App\Controllers\SuitesController;
use App\Controllers\GrandController;

$app->get('/', HomeController::class . ':index');

$app->get('/beach/ap', BeachController::class . ':index')->setName('beach.ap');
$app->post('/beach/ap', BeachController::class . ':reboot')->setName('reboot.beach.ap');
$app->post('/beach/ping', BeachController::class . ':pingAp')->setName('ping.beach.ap');

$app->get('/suites/ap', SuitesController::class . ':index')->setName('suites.ap');
$app->post('/suites/ap', SuitesController::class . ':reboot')->setName('reboot.suites.ap');
$app->post('/suites/ping', SuitesController::class . ':pingAp')->setName('ping.suites.ap');


$app->get('/grand/ap', GrandController::class . ':index')->setName('grand.ap');
$app->post('/grand/ap', GrandController::class . ':reboot')->setName('reboot.grand.ap');
$app->post('/grand/ping', SuitesController::class . ':pingAp')->setName('ping.grand.ap');