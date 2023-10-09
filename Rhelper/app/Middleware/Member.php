<?php

namespace app\Middleware;

use app\Services\Validator;

class Member
{
    public function handle()
    {
        if(!isset($_SESSION['user_type']) || $_SESSION['user_type']!== 'member')
        {
            $this->_logout();
        }

        if(!Validator::sessionClientIP()) {
            $this->_logout();
        }
    }

    private function _logout()
    {
        session_destroy();
        header('Location: /login');
        exit();
    }
}
