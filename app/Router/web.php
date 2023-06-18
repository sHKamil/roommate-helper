<?php

use app\Controllers\EventController;
use app\Controllers\GroupController;
use app\Controllers\LoginController;
use app\Controllers\RegisterController;
use app\Controllers\ScheduleController;
use app\Controllers\WelcomeController;

$router->get('/', WelcomeController::class, 'show');
$router->get('/login', LoginController::class, 'show')->only('guest');
$router->post('/login', LoginController::class, 'login');
$router->logout('/schedule', LoginController::class, 'logout');

$router->get('/register', RegisterController::class, 'show')->only('guest');
$router->post('/register', RegisterController::class, 'register')->only('guest');

$router->get('/schedule', ScheduleController::class, 'show')->only('member');

$router->get('/event/create', EventController::class, 'showCreate')->only('member');

$router->get('/group/create', GroupController::class, 'showCreate');
$router->create('/group/create', GroupController::class, 'create');

$router->get('/group/menage', GroupController::class, 'showMenage');
$router->delete('/group/menage', GroupController::class, 'delete');

$router->get('/group/join', GroupController::class, 'showJoin');
$router->join('/group/join', GroupController::class, 'join');
