<?php

namespace app\Middleware;

class Admin
{
    public function handle()
    {
        if($_SESSION['user_type'] === 'admin')
        {
            header('Location: /');
            exit();
        }
    }
}
