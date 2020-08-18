<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/denda.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$denda = new Denda($db);
  
// set ID property of record to read
$denda->id_denda = isset($_GET['id_denda']) ? $_GET['id_denda'] : die();
  
// read the details of product to be edited
$denda->readDendaPilihan();
  
if($denda->id_denda!=null){
    // create array
    $denda_arr = array(
        "id_denda" =>  $denda->id_denda,
        "id_peminjaman" => $denda->id_peminjaman,
        "jml_hari" => $denda->jml_hari,
        "total_denda" => $denda->total_denda,
        "status" => $denda->status
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($denda_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Denda does not exist."));
}
?>