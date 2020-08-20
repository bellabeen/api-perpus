<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/penerbit.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$penerbit = new Penerbit($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$penerbit->id_penerbit = $data->id_penerbit;
  
// set product property values
$penerbit->id_penerbit = $data->id_penerbit;
$penerbit->nama_penerbit = $data->nama_penerbit;
$penerbit->kota_terbit = $data->kota_terbit;
  
// update the product
if($penerbit->updatePenerbit()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Penerbit was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update Penerbit."));
}
?>