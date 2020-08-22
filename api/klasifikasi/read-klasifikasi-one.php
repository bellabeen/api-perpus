<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/klasifikasi.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$klasifikasi = new Klasifikasi($db);
  
// set ID property of record to read
$klasifikasi->id_klasifikasi = isset($_GET['id_klasifikasi']) ? $_GET['id_klasifikasi'] : die();
  
// read the details of product to be edited
$klasifikasi->readKlasifikasiPilihan();
  
if($klasifikasi->id_klasifikasi!=null){
    // create array
    $klasifikasi_arr = array(
        "id_klasifikasi" =>  $klasifikasi->id_klasifikasi,
        "klasifikasi" => $klasifikasi->klasifikasi
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($klasifikasi_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Klasifikasi does not exist."));
}
?>