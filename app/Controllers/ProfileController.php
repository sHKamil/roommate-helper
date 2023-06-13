<?php

namespace app\Controllers;

use app\Models\User;

class ProfileController
{
    private $id;
    public $model;

    public function __construct($id) {
        $this->id = $id;
        // $this->_fillUpModel();
    }

    // private function _fillUpModel(): void
    // {
    //     $user = new User();
    //     $user->findUserById($this->id);
    //     $this->model = $user;
    //     return;
    // }

}
