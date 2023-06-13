<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;

class WelcomeController implements ViewControllerInterface
{
    public $errors = [];

    public function show()
    {
        header('Location: /register');
        // view('welcome', ['errors' => $this->errors]);
    }
}