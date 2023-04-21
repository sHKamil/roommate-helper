<?php

require_once $_SESSION['BASE_PATH']."/app/Database/Database.php";
require_once $_SESSION['BASE_PATH']."/app/Models/User.php";

class ProfileController
{
    private $id;
    public $model;

    public function __construct($id) {
        $this->id = $id;
        $this->fillUpModel();
    }

    public function fillUpModel(): void
    {
        $user = new User();
        $user->findUserById($this->id);
        $this->model = $user;
        return;
    }

}
