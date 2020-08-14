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
include_once '../objects/buku.php';
  
$database = new Database();
$db = $database->getConnection();
  
$buku = new Buku($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

  
// make sure data is not empty
if(
    !empty($data->id_buku) &&
    !empty($data->judul) &&
    !empty($data->ddc) &&
    !empty($data->issn) && 
    !empty($data->no_panggil) &&
    !empty($data->penerbit) &&
    !empty($data->tahun) &&
    !empty($data->cetakan_ke) &&
    !empty($data->bahasa) &&
    !empty($data->jumlah_buku) &&
    !empty($data->klasifikasi) &&
    !empty($data->keterangan) &&
    !empty($data->cover) &&
    !empty($data->own) &&
    !empty($data->jumlah)
){
  
    // set product property values
    $buku->id_buku = $data->id_buku;
    $buku->judul = $data->judul;
    $buku->ddc = $data->ddc;
    $buku->issn = $data->issn;
    $buku->no_panggil = $data->no_panggil;
    $buku->penerbit = $data->penerbit;
    $buku->tahun = $data->tahun;
    $buku->cetakan_ke = $data->cetakan_ke;
    $buku->bahasa = $data->bahasa;
    $buku->jumlah_buku = $data->jumlah_buku;
    $buku->klasifikasi = $data->klasifikasi;
    $buku->keterangan = $data->keterangan;
    $buku->cover = $data->cover;
    $buku->own = $data->own;
    $buku->jumlah = $data->jumlah;
  
    // create the product
    if($buku->createBuku()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Buku was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create buku."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create buku. Data is incomplete."));
}
?>