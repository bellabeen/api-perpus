<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/peminjaman.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$peminjaman = new Peminjaman($db);
  
// set ID property of record to read
$peminjaman->id_peminjaman = isset($_GET['id_peminjaman']) ? $_GET['id_peminjaman'] : die();
  
// read the details of product to be edited
$peminjaman->readPeminjamanPilihan();
  
if($peminjaman->id_buku!=null){
    // create array
    $peminjaman_arr = array(
        "id_peminjaman" =>  $peminjaman->id_peminjaman,
        "id_buku" => $peminjaman->id_buku,
        "id_peminjam" => $peminjaman->id_peminjam,
        "tanggal_pesan" => $peminjaman->tanggal_pesan,
        "jam_pesan" => $peminjaman->jam_pesan,
        "expired_date" => $peminjaman->expired_date,
        "tanggal_pinjam" => $peminjaman->tanggal_pinjam,
        "batas_kembali" => $peminjaman->batas_kembali,
        "tanggal_pengembalian" => $peminjaman->tanggal_pengembalian,
        "status" => $peminjaman->status,
        "PP" => $peminjaman->PP
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($peminjaman_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Peminjaman does not exist."));
}
?>