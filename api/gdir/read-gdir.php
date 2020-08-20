<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/gdir.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$gdir = new Gdir($db);
  
// read products will be 
// query products
$stmt = $gdir->readGdir();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $gdirs_arr=array();
    $gdirs_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $gdir_item=array(
            "id_gdir" => $id_gdir,
            "id_bu" => $id_bu,
            "nama_gdir" => $nama_gdir,

        );
  
        array_push($gdirs_arr["records"], $gdir_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($gdirs_arr);
}

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No gdir found.")
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