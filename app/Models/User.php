<?php

class User{
    public $login;
    public $name;
    public $lastname;

    public function __construct($login, $name, $lastname) {
        $this->login = $login;
        $this->name = $name;
        $this->lastname = $lastname;
    }
}
