<?php

$router->get('/', 'app/Controllers/LoginController.php', 'app\Controllers\LoginController', 'show');
$router->get('/schedule','app/Views/ScheduleController.php', 'app\Controllers\ScheduleController', 'show');
