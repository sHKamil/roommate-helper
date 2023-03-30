<?php

require_once '../../config/db_config.php';

class Database
{
    private $name = DB_NAME;
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;

    private function connect()
    {
        $connection = mysqli_connect($this->host, $this->user, $this->pass,  $this->name);
        $this->checkConnection($connection);
        return $connection;
    }

    public function defaultQuery($table, $select = "*", $where = null, $limit = null)
    {
        if ($where===null){
            if($limit===null){
                $query = "SELECT ".$select." FROM ".$table.";"; //Query without LIMIT and WHERE
            }else{
                $query = "SELECT ".$select." FROM ".$table." LIMIT ".$limit.";"; //Query without WHERE
            }
        } else {
            if($limit===null){
                $query = "SELECT ".$select." FROM ".$table." WHERE ".$where." ;"; //Query without LIMIT
            }else{
            $query = "SELECT ".$select." FROM ".$table." WHERE ".$where." LIMIT ".$limit.";"; //Query with WHERE and LIMIT
            }
        }

        $connection = $this->connect();
        $this->checkConnection($connection);

        $result = mysqli_query($connection, $query);
        $this->endConnection($connection);

        return $result;
    }

    public function query($query)
    {
        $connection = $this->connect();
        $this->checkConnection($connection);

        $result = mysqli_query($connection, $query);
        $this->endConnection($connection);

        return $result;
    }

    public function insertQuery($table, $columns, $rows)
    {
        $query = 'INSERT INTO '.$table.' ('.$columns.') VALUES ('.$rows.');';

        $connection = $this->connect();
        $this->checkConnection($connection);

        $result = mysqli_query($connection, $query);
        $this->endConnection($connection);

        return $result;
    }

    private function endConnection($connection): void
    {
        mysqli_close($connection);
        return;
    }

    private function checkConnection($connection)
    {
        if (!$connection) {
            die('Connection failed: ' . mysqli_connect_error());
        }
        return;
    }

}
