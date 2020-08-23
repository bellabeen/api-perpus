<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/kontrak.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$kontrak = new Kontrak($db);
  
// read products will be 
// query products
$stmt = $kontrak->readKontrak();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $kontraks_arr=array();
    $kontraks_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $kontrak_item=array(
            "id_kontrak" => $id_kontrak,
            "nama_kontrak" => $nama_kontrak,
            

        );
  
        array_push($kontraks_arr["records"], $kontrak_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($kontraks_arr);
}

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No Jabatan found.")
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