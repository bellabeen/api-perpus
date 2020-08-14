<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/anggota.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$anggota = new Anggota($db);
  
// read products will be 
// query products
$stmt = $anggota->readAnggota();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $anggotas_arr=array();
    $anggotas_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $anggota_item=array(
            "indeks" => $indeks,
            "hp" => $hp,
            "email" => $email,
            "tanggal_daftar" => $tanggal_daftar,
            "kata_sandi" => $kata_sandi,
            "foto" => $foto,
            "status" => $status,
            "id_sesi" => $id_sesi,
            "lastlogin" => $lastlogin,
            "host" => $host,
        );
  
        array_push($anggotas_arr["records"], $anggota_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($anggotas_arr);
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