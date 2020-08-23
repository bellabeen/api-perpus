<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/karyawan.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$karyawan = new Karyawan($db);
  
// set ID property of record to read
$karyawan->indeks = isset($_GET['indeks']) ? $_GET['indeks'] : die();
  
// read the details of product to be edited
$karyawan->readKaryawanPilihan();
  
if($karyawan->indeks!=null){
    // create array
    $karyawan_arr = array(
        "indeks" =>  $karyawan->indeks,
        "nama" => $karyawan->nama,
        "bagian" => $karyawan->bagian,
        "jabatan" => $karyawan->jabatan,
        "kontrak" => $karyawan->kontrak,
        "jenis_kelamin" => $karyawan->jenis_kelamin
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($karyawan_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Karyawan does not exist."));
}
?>