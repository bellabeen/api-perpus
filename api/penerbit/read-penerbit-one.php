<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/penerbit.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$penerbit = new Penerbit($db);
  
// set ID property of record to read
$penerbit->id_penerbit = isset($_GET['id_penerbit']) ? $_GET['id_penerbit'] : die();
  
// read the details of product to be edited
$penerbit->readPenerbitPilihan();
  
if($penerbit->id_penerbit!=null){
    // create array
    $penerbit_arr = array(
        "id_penerbit" =>  $penerbit->id_penerbit,
        "nama_penerbit" => $penerbit->nama_penerbit,
        "kota_terbit" => $penerbit->kota_terbit
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($penerbit_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Penerbit does not exist."));
}
?>