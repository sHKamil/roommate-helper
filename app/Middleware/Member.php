<?php

namespace app\Middleware;

class Member
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
