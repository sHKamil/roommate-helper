<?php

require_once $_SESSION['BASE_PATH']."/app/Database/Database.php";
require_once $_SESSION['BASE_PATH']."/app/Models/User.php";

class ProfleController
{
    public $model;

    public function __construct($id) {
        $this->model = new Profile($id);
    }
}
