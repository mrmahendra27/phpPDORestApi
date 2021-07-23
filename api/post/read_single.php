<?php 

include_once '../../header.php';

$post = new Post($database->db_connect());

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$post->read_single();

$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_name' => $post->category_name,
    'category_id' => $post->category_id,
    'created_at' => $post->created_at,
);

print_r(json_encode($post_arr));