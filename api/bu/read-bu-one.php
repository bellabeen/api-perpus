<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/bu.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$bu = new Bu($db);
  
// set ID property of record to read
$bu->id_bu = isset($_GET['id_bu']) ? $_GET['id_bu'] : die();
  
// read the details of product to be edited
$bu->readBuPilihan();
  
if($bu->id_bu!=null){
    // create array
    $bu_arr = array(
        "id_bu" =>  $bu->id_bu,
        "nama_bu" =>  $bu->nama_bu,
        "sing" => $bu->sing

  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($bu_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Bu does not exist."));
}
?>