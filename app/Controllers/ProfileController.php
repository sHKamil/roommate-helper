<?php

require_once ROOT_DIR."/app/Database/Database.php";
require_once ROOT_DIR."/app/Models/Profile.php";

class ProfleController{
    public $model;

    public function __construct($id) {
        $this->model = new Profile($id);
    }
}
