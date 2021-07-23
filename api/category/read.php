<?php

require_once '../../header2.php';

$category = new Category($database->db_connect());

$result = $category->read();

if($result->rowCount() > 0){
    $category = array();
    $category['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $cate_arr = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'created_at' => $row['created_at'],
        );

        array_push($category['data'], $cate_arr);
    }
    $category['status'] = 200;   
    
    echo json_encode($category);
}else{
    echo json_encode(
        array(
            'status' => 200,
            'message' => 'No Categories Available'
        )
    );
}