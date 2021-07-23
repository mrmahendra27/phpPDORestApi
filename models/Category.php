<?php
class Category{
    
    private $connection;
    private $table = "categories";

    public $id;
    public $name;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $query = "SELECT
                id,
                name,
                created_at
            FROM " 
                . $this->table . " 
            ORDER BY
                created_at DESC";
        
        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement;
    }

}