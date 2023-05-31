<?php

namespace app\Middleware;

class Guest
{
    public function handle()
    {
        if($_SESSION['user_type'] === 'member')
        {
            header('Location: /');
            exit();
        }
    }
}