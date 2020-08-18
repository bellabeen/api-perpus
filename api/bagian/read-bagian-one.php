<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/bagian.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$bagian = new Bagian($db);
  
// set ID property of record to read
$bagian->id_bag = isset($_GET['id_bag']) ? $_GET['id_bag'] : die();
  
// read the details of product to be edited
$bagian->readBagianPilihan();
  
if($bagian->id_subdep!=null){
    // create array
    $bagian_arr = array(
        "id_bag" =>  $bagian->id_bag,
        "id_subdep" =>  $bagian->id_subdep,
        "nama_bag" => $bagian->nama_bag

  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($bagian_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Bagian does not exist."));
}
?>