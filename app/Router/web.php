<?php

$router->get('/', 'app/Controllers/LoginController.php', 'app\Controllers\LoginController', 'show');
$router->get('/login', 'app/Controllers/LoginController.php', 'app\Controllers\LoginController', 'show');

$router->get('/register', 'app/Controllers/RegisterController.php', 'app\Controllers\RegisterController', 'show');
$router->post('/register', 'app/Controllers/RegisterController.php', 'app\Controllers\RegisterController', 'register');

$router->get('/schedule','app/Views/ScheduleController.php', 'app\Controllers\ScheduleController', 'show');
