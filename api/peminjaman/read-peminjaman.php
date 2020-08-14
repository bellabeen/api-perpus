<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/peminjaman.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$peminjaman = new Peminjaman($db);
  
// read products will be 
// query products
$stmt = $peminjaman->readPeminjaman();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $peminjamans_arr=array();
    $peminjamans_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $peminjaman_item=array(
            "id_peminjaman" => $id_peminjaman,
            "id_buku" => $id_buku,
            "id_peminjam" => $id_peminjam,
            "tanggal_pesan" => $tanggal_pesan,
            "jam_pesan" => $jam_pesan,
            "expired_date" => $expired_date,
            "tanggal_pinjam" => $tanggal_pinjam,
            "batas_kembali" => $batas_kembali,
            "tanggal_pengembalian" => $tanggal_pengembalian,
            "status" => $status,
            "PP" => $PP,
        );
  
        array_push($peminjamans_arr["records"], $peminjaman_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($peminjamans_arr);
}

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
  
// else{
  
//     // set response code - 404 Not found
//     http_response_code(404);
  
//     // tell the user no products found
//     echo json_encode(
//         array("message" => "No Peminjaman found.")
//     );
// }