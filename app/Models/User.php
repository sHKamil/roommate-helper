<?php

require_once $_SESSION['BASE_PATH'] . "/app/Database/Database.php";

class User
{
    private $db;
    public $id;
    public $login;
    public $name;
    public $lastname;

    public function findUserByLogin($login, $password)
    {
        $this->db = new Database;
        $attempt = $this->db->defaultSelectQuery("users", "id, login, lastname, name", 'login="' . $login . '" AND password = "' . $password . '"');

        if ($attempt->num_rows == 1) {
            $this->asignData($attempt);
        }else{
            throw new Exception(' Login failed. '); // better frontend needed
        }
    }

    public function findUserById($id)
    {
        $this->db = new Database;
        $attempt = $this->db->defaultSelectQuery("users","id, name, lastname, login",'id='.$id.';');
 
        if ($attempt->num_rows == 1){
            $this->asignData($attempt);
        }else{
            throw new Exception(' Login failed. '); // better frontend needed
        }
    }

    private function asignData($data)
    {
        $data = $data->fetch_assoc();
        $this->id = $data["id"];
        $this->login = $data["login"];
        $this->name = $data["name"];
        $this->lastname = $data["lastname"];
    }


}
