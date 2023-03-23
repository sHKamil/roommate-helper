<?php

require_once ROOT_DIR."/app/Models/User.php";

class ProfleController{
    public $model;

    public function __construct($login, $password) {
        $this->model = new Profile($login, $password);
    }
}
