<?php

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers:, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../header2.php';

$category = new Category($database->db_connect());

$data = json_decode(file_get_contents('php://input'));

$category->name = $data->name;

if($category->create())
{
    echo json_encode(
        array(
            'status' => 200,
            'message' => 'Category Created'
        )
    );
}else{
    echo json_encode(
        array(
            'status' => 400,
            'message' => 'Category not created'
        )
    );
}