<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB and CONNECT
$database = new Database();
$db = $database->connect();

//Instantiate author object
$author = new Author($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));


//create author with auto-increment id 
if (isset($data->author)) {
    $author->author = $data->author;
    $author->create();
    echo json_encode(
        array("id"=> $db->lastInsertId(), "author"=>$author->author)
    );
    //if data is missing, send err message
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}