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
include_once '../objects/request.php';
  
$database = new Database();
$db = $database->getConnection();
  
$request = new Request($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->judul) &&
    !empty($data->pengarang) &&
    !empty($data->penerbit) &&
    !empty($data->requester) &&
    !empty($data->tgl) &&
    !empty($data->status) 
){
  
    // set product property values
    $request->id_request = $data->id_dir;
    $request->judul = $data->judul;
    $request->pengarang = $data->pengarang;
    $request->penerbit = $data->penerbit;
    $request->requester = $data->requester;
    $request->tgl = $data->tgl;
    $request->status = $data->status;
  
    // create the product
    if($request->createRequest()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Dir was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create Dir."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create dir. Data is incomplete."));
}
?>