<?php
class Post {

    private $connection;
    private $table = "posts";

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    /**
     * Class constructor.
     */
    public function __construct($db)
    {
        $this->connection = $db;
    }

    //GET data
    public function read()
    {
        //create query
        $query = "SELECT 
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM " . $this->table . " p
            LEFT JOIN
                categories c ON p.category_id = c.id
            ORDER BY
                p.created_at DESC";

        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement;
    }

    //GET single data
    public function read_single()
    {
        //query
        $query = "SELECT
                c.name as category_name,
                p.title,
                p.id,
                p.category_id,
                p.body,
                p.author,
                p.created_at
            FROM 
                " . $this->table . " p
            LEFT JOIN
                categories c ON p.category_id = c.id
            WHERE
                p.id = ?
            LIMIT 0,1";
        
        $statement = $this->connection->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->author = $row['author'];
        $this->body = $row['body'];
        $this->category_name = $row['category_name'];
        $this->category_id = $row['category_id'];
        $this->created_at = $row['created_at'];
    }

    //Create POST
    public function create()
    {
        $query = "INSERT INTO " . $this->table . "
        SET
            title = :title,
            author = :author,
            body = :body,
            category_id = :category_id";
        
        $statement = $this->connection->prepare($query);

        //clean
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        if($statement->execute(['title' => $this->title,'author' => $this->author,'body' => $this->body,'category_id' => $this->category_id])){
            return true;
        }

        printf('Error: %s.\n', $statement->error);
        return false;
    }

    public function update()
    {
        $query = "UPDATE " . 
                $this->table . " 
            SET
                title = :title,
                author = :author,
                body = :body,
                category_id = :category_id
            WHERE
                id = :id";
        
        $statement = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':author', $this->author);
        $statement->bindParam(':body', $this->body);
        $statement->bindParam(':category_id', $this->category_id);
        $statement->bindParam(':id', $this->id);

        if($statement->execute()){
            return true;
        }

        printf('Error: %s.\n', $statement->error);
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " .
                $this->table . " 
            WHERE
                id= :id";
        
        $statement = $this->connection->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(':id', $this->id);

        if($statement->execute()){
            return true;
        }

        printf("Error: %s.\n". $statement->error);
        return false;

    }
}