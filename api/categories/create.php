<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB and CONNECT
$database = new Database();
$db = $database->connect();

//Instantiate Category object
$category = new Category($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));


//create category with auto-increment id 
if (isset($data->category)) {
    $category->category = $data->category;
    $category->create();
    echo json_encode(
        array("id"=> $db->lastInsertId(), "category"=>$category->category)
    );
    //if data is missing, send err message
} else {
    echo json_encode(
        array('message'=>'Missing Required Parameters')
    );
}