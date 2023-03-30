<?php

require_once "../Database/Database.php";
require_once "../Models/User.php";

class ProfleController
{
    public $model;

    public function __construct($id) {
        $this->model = new Profile($id);
    }
}
