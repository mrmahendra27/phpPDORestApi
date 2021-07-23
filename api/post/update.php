<?php

include_once '../../header.php';

$post = new Post($database->db_connect());


$id = isset($_GET['id']) ? $_GET['id'] : die();

if($id){

    $data = json_decode(file_get_contents('php://input'));

    $post->id = $id;
    $post->title = $data->title;
    $post->author = $data->author;
    $post->body = $data->body;
    $post->category_id = $data->category_id;

    if($post->update()){
        echo json_encode(array(
            'status' => 200,
            'message' => 'Post Updated'
        ));
    }else{
        echo json_encode(array(
            'status' => 401,
            'message' => 'Post Not Updated'
        ));
    }
}

