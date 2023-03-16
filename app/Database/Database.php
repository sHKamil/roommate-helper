<?php

require_once ROOT_DIR.'/config/db_config.php';

class Database {
    
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

    public function query($table, $select = "*", $where = null, $limit = "100")
    {
        if ($where===null){
            $query = "SELECT ".$select." FROM ".$table." LIMIT ".$limit.";"; //Query without WHERE
        } else {
            $query = "SELECT ".$select." FROM ".$table." WHERE ".$where." LIMIT ".$limit.";"; //Query with WHERE
        }

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

?>
