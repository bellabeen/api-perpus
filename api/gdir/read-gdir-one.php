<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/gdir.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$gdir = new Gdir($db);
  
// set ID property of record to read
$gdir->id_gdir = isset($_GET['id_gdir']) ? $_GET['id_gdir'] : die();
  
// read the details of product to be edited
$gdir->readGdirPilihan();
  
if($gdir->id_gdir!=null){
    // create array
    $gdir_arr = array(
        "id_gdir" =>  $gdir->id_gdir,
        "id_bu" => $gdir->id_bu,
        "nama_gdir" => $gdir->nama_gdir
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($gdir_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Gdir does not exist."));
}
?>