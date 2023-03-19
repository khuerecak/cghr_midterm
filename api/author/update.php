<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate author object
$author = new author($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Update author
if (isset($data->author)) {
     // Set ID to UPDATE
    $author->id = $data->id;
    $author->author = $data->author;
    $author->update();
    echo json_encode(
        array("id"=>$author->id, "author"=>$author->author)
    );
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}
