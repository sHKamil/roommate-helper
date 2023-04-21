<?php

require_once $_SESSION['BASE_PATH'] . "/app/Database/Database.php";

class User
{
    private $db;
    public $id;
    public $login;
    public $name;
    public $lastname;

    // public function __construct() {
    //     try {
    //         $this->findUserByLogin($login, $password);
    //     } catch (Exception $e) {
            
    //     }
    // }

    public function findUserByLogin($login, $password)
    {
        $this->db = new Database;
        $attempt = $this->db->defaultSelectQuery("users", "id, login, name", 'login="' . $login . '" AND password = "' . $password . '"');

        if ($attempt->num_rows == 1) {
            $attempt = $attempt->fetch_assoc();
            $this->id = $attempt["id"];
            $this->login = $attempt["login"];
            $this->name = $attempt["name"];
        }else{
            throw new Exception(' Login failed. '); // better frontend needed
        }
    }
}
