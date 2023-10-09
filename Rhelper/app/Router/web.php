<?php

use app\Controllers\EventController;
use app\Controllers\GroupController;
use app\Controllers\LoginController;
use app\Controllers\ProfileController;
use app\Controllers\RegisterController;
use app\Controllers\ScheduleController;
use app\Controllers\SupplyController;

$router->get('/', LoginController::class, 'show')->only('guest');
$router->post('/', LoginController::class, 'login')->only('guest');
$router->get('/login', LoginController::class, 'show')->only('guest');
$router->post('/login', LoginController::class, 'login')->only('guest');

$router->logout('/schedule', LoginController::class, 'logout')->only('member');
$router->logout('/profile', LoginController::class, 'logout')->only('member');
$router->logout('/event', LoginController::class, 'logout')->only('member');
$router->logout('/group-create', LoginController::class, 'logout')->only('member');
$router->logout('/group-join', LoginController::class, 'logout')->only('member');
$router->logout('/supply', LoginController::class, 'logout')->only('member');

$router->get('/register', RegisterController::class, 'show')->only('guest');
$router->post('/register', RegisterController::class, 'register')->only('guest');

$router->get('/schedule', ScheduleController::class, 'show')->only('member');

$router->get('/profile', ProfileController::class, 'show')->only('member');
$router->edit('/profile', ProfileController::class, 'update')->only('member');
$router->delete('/profile', GroupController::class, 'quit')->only('member');

$router->get('/event', EventController::class, 'show')->only('member');
$router->create('/event', EventController::class, 'create')->only('member');
$router->edit('/event', EventController::class, 'showEdit')->only('member');
$router->patch('/event', EventController::class, 'update')->only('member');
$router->delete('/event', EventController::class, 'delete')->only('member');

$router->get('/group-create', GroupController::class, 'showCreate')->only('member');
$router->create('/group-create', GroupController::class, 'create')->only('member');

$router->get('/group-join', GroupController::class, 'showJoin')->only('member');
$router->join('/group-join', GroupController::class, 'join')->only('member');

$router->get('/supply', SupplyController::class, 'show')->only('member');
$router->post('/supply', SupplyController::class, 'create')->only('member');
$router->delete('/supply', SupplyController::class, 'delete')->only('member');
$router->edit('/supply', SupplyController::class, 'showEdit')->only('member');
$router->patch('/supply', SupplyController::class, 'update')->only('member');
