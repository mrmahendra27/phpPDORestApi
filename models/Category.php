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

    public function read_single()
    {
        $query = "SELECT 
                id,
                name,
                created_at
            FROM "
                . $this->table . " 
            WHERE
                id= :id";
        
        $statement = $this->connection->prepare($query);

        $statement->bindParam('id', $this->id);

        $statement->execute();

        return $statement;
    }

    public function create()
    {
        $query = "INSERT INTO "
                . $this->table . " 
            SET
                name= :name";
                
        $statement = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));

        $statement->bindParam('name', $this->name);

        if($statement->execute()){
            return true;
        }

        printf("Error: %s.\n" . $statement->error);
        return false;
    }

    public function update()
    {
        $query = "UPDATE "
                . $this->table . " 
            SET
                name= :name
            WHERE
                id= :id";
                
        $statement = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));

        $statement->bindParam('name', $this->name);
        $statement->bindParam('id', $this->id);

        if($statement->execute()){
            return true;
        }

        printf("Error: %s.\n" . $statement->error);
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM "
                . $this->table . " 
            WHERE
                id= :id";
                
        $statement = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam('id', $this->id);

        if($statement->execute()){
            return true;
        }

        printf("Error: %s.\n" . $statement->error);
        return false;
    }

}