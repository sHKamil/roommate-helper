<?php

namespace app\Middleware;

class Owner
{
    public function handle()
    {
        // if($_SESSION['user_type'] === 'owner')
        // {
        //     header('Location: /');
        //     exit();
        // }
    }
}
