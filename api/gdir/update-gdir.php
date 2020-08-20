<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/gdir.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$gdir = new Gdir($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$gdir->id_gdir = $data->id_gdir;
  
// set product property values
$gdir->id_gdir = $data->id_gdir;
$gdir->id_bu = $data->id_bu;
$gdir->nama_gdir = $data->nama_gdir;
  
// update the product
if($gdir->updateGdir()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Gdir was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update Gdir."));
}
?>