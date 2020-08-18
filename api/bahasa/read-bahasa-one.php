<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/bahasa.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$bahasa = new Bahasa($db);
  
// set ID property of record to read
$bahasa->id_bahasa = isset($_GET['id_bahasa']) ? $_GET['id_bahasa'] : die();
  
// read the details of product to be edited
$bahasa->readBahasaPilihan();
  
if($bahasa->id_bahasa!=null){
    // create array
    $bahasa_arr = array(
        "id_bahasa" =>  $bahasa->id_bahasa,
        "bahasa" =>  $bahasa->bahasa

  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($bahasa_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Bahasa does not exist."));
}
?>