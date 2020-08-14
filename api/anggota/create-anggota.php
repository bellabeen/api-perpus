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
include_once '../objects/anggota.php';
  
$database = new Database();
$db = $database->getConnection();
  
$anggota = new Anggota($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->indeks) &&
    !empty($data->hp) &&
    !empty($data->email) &&
    !empty($data->tanggal_daftar) && 
    !empty($data->kata_sandi) &&
    !empty($data->foto) &&
    !empty($data->status) &&
    !empty($data->id_sesi) &&
    !empty($data->lastlogin) &&
    !empty($data->host)
){
  
    // set product property values
    $anggota->indeks = $data->indeks;
    $anggota->hp = $data->hp;
    $anggota->email = $data->email;
    $anggota->tanggal_daftar = date('Y-m-d');
    $anggota->kata_sandi = $data->kata_sandi;
    $anggota->foto = $data->foto;
    $anggota->status = $data->status;
    $anggota->id_sesi = $data->id_sesi;
    $anggota->lastlogin = date('Y-m-d H:i:s');
    $anggota->host = $data->host;

  
    // create the product
    if($anggota->createAnggota()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Anggota was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create anggota."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create anggota. Data is incomplete."));
}
?>