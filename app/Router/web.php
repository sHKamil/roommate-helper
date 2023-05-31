<?php

$router->get('/', 'app/Controllers/WelcomeController.php', 'app\Controllers\WelcomeController', 'show');
$router->get('/login', 'app/Controllers/LoginController.php', 'app\Controllers\LoginController', 'show')->only('guest');
$router->post('/login', 'app/Controllers/LoginController.php', 'app\Controllers\LoginController', 'login')->only('guest');

$router->get('/register', 'app/Controllers/RegisterController.php', 'app\Controllers\RegisterController', 'show')->only('guest');
$router->post('/register', 'app/Controllers/RegisterController.php', 'app\Controllers\RegisterController', 'register')->only('guest');

$router->get('/schedule','app/Controllers/ScheduleController.php', 'app\Controllers\ScheduleController', 'show')->only('member');
