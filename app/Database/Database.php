<?php

require_once $_SESSION['BASE_PATH'] . "/config/db_config.php";

class Database
{
    private $name = DB_NAME;
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $user = DB_USER;
    private $pass = DB_PASS;

    private function _connect()
    {
        try {
            $connection = mysqli_connect($this->host, $this->user, $this->pass,  $this->name, $this->port);

            // Connection check
            if ($connection->connect_errno) {
                throw new Exception("Connection failed: " . $connection->connect_error);
            }
            
            // Successful connection
            return $connection;
        } catch (Exception $e) {
            // Connection error
            echo "Connection failed: " . $e->getMessage();
          }
        
    }

    public function query($query)
    {
        $connection = $this->_connect();

        $result = mysqli_query($connection, $query);
        $this->_endConnection($connection);

        return $result;
    }

    public function secureQuery($query, $params)
    {
        $connection = $this->_connect();
        $statement = $connection->prepare($query);

        $statement->execute($params);

        $this->_endConnection($connection);

        return $statement;
    }

    public function insertQuery($table, $columns, $rows)
    {
        $query = 'INSERT INTO ' . $table . ' (' . $columns . ') VALUES (' . $rows . ');';

        $connection = $this->_connect();
        $this->checkTableExists($table);

        $result = mysqli_query($connection, $query);
        $this->_endConnection($connection);

        return $result;
    }

    private function _endConnection($connection): void
    {
        mysqli_close($connection);
        return;
    }
    
    protected function checkTableExists($table)
    {
        $result = mysqli_num_rows($this->query('SHOW TABLES LIKE "' . $table . '"; '));

        if ($result != 1) {
            return false;
            // die('Query error: Table <i>"' . $table . '"</i> not found. <br>' . mysqli_connect_error());
        }else{       
            return true;
        }
    }
}
