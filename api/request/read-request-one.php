<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/request.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$request = new Request($db);
  
// set ID property of record to read
$request->id_request = isset($_GET['id_request']) ? $_GET['id_request'] : die();
  
// read the details of product to be edited
$request->readRequestPilihan();
  
if($request->id_request!=null){
    // create array
    $request_arr = array(
        "id_request" =>  $request->id_request,
        "judul" => $request->judul,
        "pengarang" => $request->pengarang,
        "penerbit" => $request->penerbit,
        "requester" => $request->requester,
        "tgl" => $request->tgl,
        "status" => $request->status
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($request_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Request does not exist."));
}
?>