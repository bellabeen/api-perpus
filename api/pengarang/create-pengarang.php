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
include_once '../objects/pengarang.php';
  
$database = new Database();
$db = $database->getConnection();
  
$pengarang = new Pengarang($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

  
// make sure data is not empty
if(
    !empty($data->id_pengarang) &&
    !empty($data->nama_pengarang)
){
  
    // set product property values
    $pengarang->id_pengarang = $data->id_pengarang;
    $pengarang->nama_pengarang = $data->nama_pengarang;

  
    // create the product
    if($pengarang->createPengarang()){
  
        // set response code - 201 created
        http_response_code(200);
  
        // tell the user
        echo json_encode(array("message" => "Pengarang was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create pengarang."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create pengarang. Data is incomplete."));
}
?>