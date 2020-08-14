<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/anggota.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$anggota = new Anggota($db);
  
// set ID property of record to read
$anggota->indeks = isset($_GET['indeks']) ? $_GET['indeks'] : die();
  
// read the details of product to be edited
$anggota->readAnggotaPilihan();
  
if($anggota->hp!=null){
    // create array
    $anggota_arr = array(
        "indeks" =>  $anggota->indeks,
        "hp" => $anggota->hp,
        "email" => $anggota->email,
        "tanggal_daftar" => $anggota->tanggal_daftar,
        "kata_sandi" => $anggota->kata_sandi,
        "foto" => $anggota->foto,
        "status" => $anggota->status,
        "id_sesi" => $anggota->id_sesi,
        "lastlogin" => $anggota->lastlogin,
        "host" => $anggota->host
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($anggota_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Anggota does not exist."));
}
?>