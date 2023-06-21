<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;
use app\Models\Group;
use app\Models\User;

class ProfileController implements ViewControllerInterface
{
    private $errors;
    public $model;

    public function show(string $alert = '')
    {
        return view('profile', [
            'errors' => $this->errors,
            'group' => $this->prepareGroupData()
        ], $alert);
    }

    public function prepareGroupData() : array
    {
        $group_controller = new GroupController;
        $rows = $group_controller->getMyGroup();
        
        return $rows;
    }
}
