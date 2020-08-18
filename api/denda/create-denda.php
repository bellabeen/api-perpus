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
include_once '../objects/denda.php';
  
$database = new Database();
$db = $database->getConnection();
  
$denda = new Denda($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->id_peminjaman) &&
    !empty($data->jml_hari) &&
    !empty($data->total_denda) &&
    !empty($data->status)
){
  
    // set product property values
    $denda->id_denda = $data->id_denda;
    $denda->id_peminjaman = $data->id_peminjaman;
    $denda->jml_hari = $data->jml_hari;
    $denda->total_denda = $data->total_denda;
    $denda->status = $data->status;
  
    // create the product
    if($denda->createDenda()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Denda was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create denda."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create peminjaman. Data is incomplete."));
}
?>