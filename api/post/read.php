<?php

include_once '../../header.php';

//instatiating post objecting and passing db
$post = new Post($database->db_connect());

$result = $post->read();

$data = $result->rowCount();

if($data > 0){
    $posts = array();
    $posts['status'] = null;
    $posts['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $posts_item = array(
            'id' => $id,
            'title' => $title,
            'author' => $author,
            'body' => html_entity_decode($body),
            'category_id' => $category_id,
            'category_name' => $category_name,
            'created_at' => $created_at,
        );

        //push
        array_push($posts['data'], $posts_item);
    }
    $posts['status']  = 200;
    echo json_encode($posts);
}else{
    echo json_encode(array(
        'status' => 401,
        'message' => 'no data'
    ));
}

