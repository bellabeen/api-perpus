<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/departemen.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$departemen = new Departemen($db);
  
// set ID property of record to read
$departemen->id_dep = isset($_GET['id_dep']) ? $_GET['id_dep'] : die();
  
// read the details of product to be edited
$departemen->readDepartemenPilihan();
  
if($departemen->id_dep!=null){
    // create array
    $departemen_arr = array(
        "id_dep" =>  $departemen->id_dep,
        "id_subdiv" => $departemen->id_subdiv,
        "nama_dep" => $departemen->nama_dep
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($departemen_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Departemen does not exist."));
}
?>