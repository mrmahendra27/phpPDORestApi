<?php
class Database
{
    //DB params
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "my-blog";
    private $connection;


    //DB connect

    public function db_connect()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            echo "Connection error " . $e->getMessage();
        }
    }
}
