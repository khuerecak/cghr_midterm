<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog category object
$category = new Category($db);

//Get ID 
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get Category
$category->read_single();

//Create array
if ($category->category === false) {
    echo json_encode(array('message'=>'category_id Not Found'));
} else {
    //Make JSON
    print_r(json_encode($category->category));
}
