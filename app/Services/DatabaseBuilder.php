<?php
// It will be completely remake in the future.
// Now its only for quick rebuilding database on different machines

namespace app\Services;

use app\Database\Database;

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
        if(isset($this->failed_tables[0]) && $this->failed_tables[0]=="users") $this->_dbTypeChoose();
    }

    private function _dbTypeChoose()
    {
        $query = 'SELECT @@version_comment;';
        $db_type = $this->query($query);

        if(substr($db_type, 0, 5) === "Maria") return $this->_buildUsersMariaDB();
        if(substr($db_type, 0, 5) === "MySQL") return $this->_buildUsersMySQL();

        return $this->_unknownDBType();
    }

    private function _buildUsersMariaDB()
    {
        $query = '
            CREATE TABLE users (
                id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
                login VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                name VARCHAR(255),
                lastname VARCHAR(255)
            );
          ';
        $this->query($query);
        return;
    }

    private function _buildUsersMySQL()
    {
        $query = '
            CREATE TABLE `users` (
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

    private function _unknownDBType(): void
    {
        die("UnknownDBType");
        return;
    }
}
