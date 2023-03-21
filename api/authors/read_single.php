<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog author object
$author = new author($db);

//Get ID 
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get author
$author->read_single();

//Create array 
if ($author->author === false) {
    echo json_encode(array('message' => 'author_id Not Found'));
} else {
    //Make JSON
    print_r(json_encode($author->author));
}
