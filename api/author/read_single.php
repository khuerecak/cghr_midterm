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
$author_arr = array(
    'id' => $author->id,
    'author' => $author->author
);

if($author->author !== null){
    //Change to JSON data
    print_r(json_encode($author_arr, JSON_NUMERIC_CHECK));
    }
//cant find author_id 
else
    {
        echo json_encode(
            array('message' => 'author_id not Found')
        );
    }
