<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Quote.php');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate quote object
$quote = new Quote($db);

//Get raw quotes data
$data = json_decode(file_get_contents("php://input"));

// create quote based on whether author and category id's are provided 

if(isset($data->quote) and isset($data->author_id) and isset($data->category_id)) {
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    $quote->create();
    echo json_encode(
        array("id"=> $db->lastInsertId(), "quote"=>$quote->quote, "author_id"=>$quote->author_id, "category_id"=>$quote->category_id)
    );
} else {
    echo json_encode(
        array('message'=>'Missing Required Parameters')
    );
}