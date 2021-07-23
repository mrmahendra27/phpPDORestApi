<?php

include_once '../../header.php';

$post = new Post($database->db_connect());

$id = isset($_GET['id']) ? $_GET['id'] : die();

if($id){
    $post->id = $id;
    if($post->delete()){
        echo json_encode(array(
            'status' => 200,
            'message' => 'Post Deleted'
        ));
    }else{
        echo json_encode(array(
            'status' => 401,
            'message' => 'Post Not Deleted'
        ));
    }
}