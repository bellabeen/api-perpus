<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/kontrak.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$kontrak = new Kontrak($db);
  
// set ID property of record to read
$kontrak->id_kontrak = isset($_GET['id_kontrak']) ? $_GET['id_kontrak'] : die();
  
// read the details of product to be edited
$kontrak->readKontrakPilihan();
  
if($kontrak->id_kontrak!=null){
    // create array
    $kontrak_arr = array(
        "id_kontrak" =>  $kontrak->id_kontrak,
        "nama_kontrak" =>  $kontrak->nama_kontrak

  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($kontrak_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Kontrak does not exist."));
}
?>