<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/dir.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$dir = new Dir($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$dir->id_dir = $data->id_dir;
  
// set product property values
$dir->id_dir = $data->id_dir;
$dir->id_gdir = $data->id_gdir;
$dir->nama_dir = $data->nama_dir;
  
// update the product
if($dir->updateDir()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Dir was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update Dir."));
}
?>