<?php

namespace app\Middleware;

class Guest
{
    public function handle()
    {
        if($_SESSION['user_type'] ?? false)
        {
            header('Location: /');
            exit();
        }
    }
}
