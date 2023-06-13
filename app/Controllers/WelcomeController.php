<?php

namespace app\Controllers;

class WelcomeController
{
    public $errors = [];

    public function show()
    {
        view('welcome', ['errors' => $this->errors]);
    }
}