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
include_once '../objects/karyawan.php';
  
$database = new Database();
$db = $database->getConnection();
  
$karyawan = new Karyawan($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->indeks) &&
    !empty($data->nama) &&
    !empty($data->bagian) &&
    !empty($data->jabatan) &&
    !empty($data->kontrak) &&
    !empty($data->jenis_kelamin)
){
  
    // set product property values
    $karyawan->indeks = $data->indeks;
    $karyawan->nama = $data->nama;
    $karyawan->bagian = $data->bagian;
    $karyawan->jabatan = $data->jabatan;
    $karyawan->kontrak = $data->kontrak;
    $karyawan->jenis_kelamin = $data->jenis_kelamin;
  
    // create the product
    if($karyawan->createKaryawan()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Karyawan was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create Karyawan."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create detil vote. Data is incomplete."));
}
?>