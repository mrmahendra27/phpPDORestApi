<?php

header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers:, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../header2.php';

$category = new Category($database->db_connect());

$id = isset($_GET['id']) ? $_GET['id'] : die();

if($id){
    $category->id = $id;
    
    if($category->delete())
    {
        echo json_encode(
            array(
                'status' => 200,
                'message' => 'Category Deleted'
            )
        );
    }else{
        echo json_encode(
            array(
                'status' => 400,
                'message' => 'Category not Deleted'
            )
        );
    }
}