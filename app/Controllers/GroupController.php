<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;

class GroupController implements ViewControllerInterface
{
    public $errors;

    public function show(string $alert = '')
    {
        return view('group', [
            "errors" => $this->errors
        ], $alert);
    }

    public function showCreate(string $alert = '')
    {
        return view('group-create', [
            "errors" => $this->errors
        ], $alert);
    }

    public function showJoin(string $alert = '')
    {
        return view('group-join', [
            "errors" => $this->errors
        ], $alert);
    }

    public function join()
    {
        
    }
}
