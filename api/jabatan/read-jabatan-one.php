<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/jabatan.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$jabatan = new Jabatan($db);
  
// set ID property of record to read
$jabatan->id_jabatan = isset($_GET['id_jabatan']) ? $_GET['id_jabatan'] : die();
  
// read the details of product to be edited
$jabatan->readJabatanPilihan();
  
if($jabatan->id_jabatan!=null){
    // create array
    $jabatan_arr = array(
        "id_jabatan" =>  $jabatan->id_jabatan,
        "nama_jabatan" =>  $jabatan->nama_jabatan

  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($jabatan_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Jabatan does not exist."));
}
?>