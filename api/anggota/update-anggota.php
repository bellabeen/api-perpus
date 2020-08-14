<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/anggota.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$anggota = new Anggota($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$anggota->indeks = $data->indeks;
  
// set product property values
$anggota->indeks = $data->indeks;
$anggota->hp = $data->hp;
$anggota->email = $data->email;
$anggota->tanggal_daftar = $data->tanggal_daftar;
$anggota->kata_sandi = $data->kata_sandi;
$anggota->foto = $data->foto;
$anggota->status = $data->status;
$anggota->id_sesi = $data->id_sesi;
$anggota->lastlogin = $data->lastlogin;
$anggota->host = $data->host;

  
// update the product
if($anggota->updateAnggota()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Anggota was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update anggota."));
}
?>