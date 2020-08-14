<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/buku.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$buku = new Buku($db);
  
// read products will be 
// query products
$stmt = $buku->readBuku();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $bukus_arr=array();
    $bukus_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $buku_item=array(
            "id_buku" => $id_buku,
            "judul" => $judul,
            "ddc" => $ddc,
            "issn" => $issn,
            "no_panggil" => $no_panggil,
            "penerbit" => $penerbit,
            "tahun" => $tahun,
            "cetakan_ke" => $cetakan_ke,
            "bahasa" => $bahasa,
            "jumlah_buku" => $jumlah_buku,
            "klasifikasi" => $klasifikasi,
            "keterangan" => $keterangan,
            "cover" => $cover,
            "own" => $own,
            "jumlah" => $jumlah,
        );
  
        array_push($bukus_arr["records"], $buku_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($bukus_arr);
}

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No buku found.")
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