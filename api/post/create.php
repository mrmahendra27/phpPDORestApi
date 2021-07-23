<?php

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers:, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../header.php';

$post = new Post($database->db_connect());


$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

if($post->create()){
    echo json_encode(array(
        'status' => 200,
        'message' => 'Post Created'
    ));
}else{
    echo json_encode(array(
        'status' => 401,
        'message' => 'Post Not Created'
    ));
}


