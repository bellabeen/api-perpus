<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/denda.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$denda = new Denda($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$denda->id_denda = $data->id_denda;
  
// set product property values
$denda->id_denda = $data->id_denda;
$denda->id_peminjaman = $data->id_peminjaman;
$denda->jml_hari = $data->jml_hari;
$denda->total_denda = $data->total_denda;
$denda->status = $data->status;
  
// update the product
if($denda->updateDenda()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Denda was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update Denda."));
}
?>