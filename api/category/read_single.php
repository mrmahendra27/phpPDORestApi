<?php

include_once '../../header2.php';

$category = new Category($database->db_connect());

$id = isset($_GET['id']) ? $_GET['id'] : die();

if($id){
    $category->id = $id;

    $result = $category->read_single();

    $data = $result->fetch(PDO::FETCH_ASSOC);
    
    $cate = array(
        'id' => $data['id'],
        'name' => $data['name'],
        'created_at' => $data['created_at'],
    );

    echo json_encode($cate);
}else{
    echo json_encode(array(
        'status' => 400,
        'message' => 'wrong id'
    ));
}
