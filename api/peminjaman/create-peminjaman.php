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
include_once '../objects/peminjaman.php';
  
$database = new Database();
$db = $database->getConnection();
  
$peminjaman = new Peminjaman($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));


// $stmt->bindParam(":id_buku", $this->id_buku);
// $stmt->bindParam(":id_peminjam", $this->id_peminjam);
// $stmt->bindParam(":tanggal_pesan", $this->tanggal_pesan);
// $stmt->bindParam(":jam_pesan", $this->jam_pesan);
// $stmt->bindParam(":expired_date", $this->expired_date);
// $stmt->bindParam(":tanggal_pinjam", $this->tanggal_pinjam);
// $stmt->bindParam(":batas_kembali", $this->batas_kembali);
// $stmt->bindParam(":tanggal_pengembalian", $this->tanggal_pengembalian);
// $stmt->bindParam(":status", $this->status);
// $stmt->bindParam(":PP", $this->PP);
  
// make sure data is not empty
if(
    !empty($data->id_buku) &&
    !empty($data->id_peminjam) &&
    !empty($data->tanggal_pesan) &&
    !empty($data->jam_pesan) && 
    !empty($data->expired_date) &&
    !empty($data->tanggal_pinjam) &&
    !empty($data->batas_kembali) &&
    !empty($data->tanggal_pengembalian) &&
    !empty($data->status) &&
    !empty($data->PP)
){
  
    // set product property values
    $peminjaman->id_buku = $data->id_buku;
    $peminjaman->id_peminjam = $data->id_peminjam;
    $peminjaman->tanggal_pesan = date('Y-m-d');
    $peminjaman->jam_pesan = time('H:i:s');
    $peminjaman->expired_date = date('Y-m-d H:i:s');
    $peminjaman->tanggal_pinjam = date('Y-m-d');
    $peminjaman->batas_kembali = date('Y-m-d');
    $peminjaman->tanggal_pengembalian = date('Y-m-d');
    $peminjaman->status = $data->status;
    $peminjaman->PP = $data->PP;
  
    // create the product
    if($peminjaman->createPeminjaman()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Peminjaman was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create peminjaman. Data is incomplete."));
}
?>