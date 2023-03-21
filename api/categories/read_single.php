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
//$category_arr = array(
//    'id' => $category->id,
//   'category' => $category->category
//);

if($category->category !== null){
    //Change to JSON data
    print_r(json_encode($category_arr, JSON_NUMERIC_CHECK));
    }
//cant find category_id 
else
    {
        echo json_encode(
            array('message' => 'category_id not Found')
        );
    }
