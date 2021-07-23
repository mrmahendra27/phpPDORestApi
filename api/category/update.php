<?php

header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers:, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../header2.php';

$category = new Category($database->db_connect());

$id = isset($_GET['id']) ? $_GET['id'] : die();

if($id){    
    $data = json_decode(file_get_contents('php://input'));

    $category->id = $id;

    $category->name = $data->name;
    
    if($category->update())
    {
        echo json_encode(
            array(
                'status' => 200,
                'message' => 'Category Updated'
            )
        );
    }else{
        echo json_encode(
            array(
                'status' => 400,
                'message' => 'Category not Updated'
            )
        );
    }
}