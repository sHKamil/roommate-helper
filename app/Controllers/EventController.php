<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;

class EventController implements ViewControllerInterface
{
    public $errors;

    public function show(string $alert = '')
    {
        return view('event', [
            "errors" => $this->errors
        ], $alert);
    }

    public function showCreate(string $alert = '')
    {
        return view('event-create', [
            "errors" => $this->errors
        ], $alert);
    }
}