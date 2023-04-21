<?php
// It will be completely remake in the future.
// Now its only for quick rebuilding database on different machines

require_once $_SESSION['BASE_PATH'] . "/app/Database/Database.php";

class DatabaseBuilder extends Database
{
    private $tables = ['users'];
    private $failed_tables = [];

    public function __construct()
    {
        foreach ($this->tables as $table) {
            if (!$this->checkTableExists($table)) {
                array_push($this->failed_tables, $table);
            };
        }
        if(isset($this->failed_tables[0]) && $this->failed_tables[0]=="users") $this->_buildUsers();
    }

    private function _buildUsers()
    {
        $query = 
            'CREATE TABLE `users` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `login` VARCHAR(45) NULL,
            `password` VARCHAR(45) NULL,
            `name` VARCHAR(45) NULL,
            `lastname` VARCHAR(45) NULL,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `login_UNIQUE` (`login` ASC) VISIBLE);
          ';
        $this->query($query);
        return;
    }
}
