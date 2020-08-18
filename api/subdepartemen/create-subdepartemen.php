<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/subdepartemen.php';
  
$database = new Database();
$db = $database->getConnection();
  
$subdepartemen = new Subdepartemen($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->id_subdep) &&
    !empty($data->id_dep) &&
    !empty($data->nama_bag) 
){
  
    // set product property values
    $subdepartemen->id_subdep = $data->id_subdep;
    $subdepartemen->id_dep = $data->id_dep;
    $subdepartemen->nama_bag = $data->nama_bag;


  
    // create the product
    if($subdepartemen->createSubdepartemen()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Subdepartemen was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create subdepartemen."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create bagian. Data is incomplete."));
}
?>