<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/subdepartemen.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$subdepartemen = new Subdepartemen($db);
  
// set ID property of record to read
$subdepartemen->id_subdep = isset($_GET['id_subdep']) ? $_GET['id_subdep'] : die();
  
// read the details of product to be edited
$subdepartemen->readSubdepartemenPilihan();
  
if($subdepartemen->id_subdep!=null){
    // create array
    $subdepartemen_arr = array(
        "id_subdep" =>  $subdepartemen->id_subdep,
        "id_dep" =>  $subdepartemen->id_dep,
        "nama_subdep" => $subdepartemen->nama_subdep

  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($subdepartemen_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Subdepartemen does not exist."));
}
?>