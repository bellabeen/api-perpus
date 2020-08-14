<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/peminjaman.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$peminjaman = new Peminjaman($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$peminjaman->id_peminjaman = $data->id_peminjaman;
  
// set product property values
$peminjaman->id_buku = $data->id_buku;
$peminjaman->id_peminjam = $data->id_peminjam;
$peminjaman->tanggal_pesan = $data->tanggal_pesan;
$peminjaman->jam_pesan = $data->jam_pesan;
$peminjaman->expired_date = $data->expired_date;
$peminjaman->tanggal_pinjam = $data->tanggal_pinjam;
$peminjaman->batas_kembali = $data->batas_kembali;
$peminjaman->tanggal_pengembalian = $data->tanggal_pengembalian;
$peminjaman->status = $data->status;
$peminjaman->PP = $data->PP;
  
// update the product
if($peminjaman->updatePeminjaman()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Peminjaman was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update peminjaman."));
}
?>