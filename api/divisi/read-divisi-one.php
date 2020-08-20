<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/divisi.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$divisi = new Divisi($db);
  
// set ID property of record to read
$divisi->id_div = isset($_GET['id_div']) ? $_GET['id_div'] : die();
  
// read the details of product to be edited
$divisi->readDivisiPilihan();
  
if($divisi->id_div!=null){
    // create array
    $divisi_arr = array(
        "id_div" =>  $divisi->id_div,
        "id_dir" => $divisi->id_dir,
        "nama_div" => $divisi->nama_div
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($divisi_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Divisi does not exist."));
}
?>