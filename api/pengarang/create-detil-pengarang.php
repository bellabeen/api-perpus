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
include_once '../objects/pengarang.php';
  
$database = new Database();
$db = $database->getConnection();
  
$detail_pengarang = new DetailPengarang($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->id_buku) &&
    !empty($data->id_pengarang) &&
    !empty($data->ket)
){
  
    // set product property values
    $detail_pengarang->id_buku = $data->id_buku;
    $detail_pengarang->id_pengarang = $data->id_pengarang;
    $detail_pengarang->ket = $data->ket;

    // create the product
    if($detail_pengarang->createDetailPengarang()){
  
        // set response code - 201 created
        http_response_code(200);
  
        // tell the user
        echo json_encode(array("message" => "Detail Detail Pengarang was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create Detail Pengarang."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create Detail Pengarang. Data is incomplete."));
}
?>