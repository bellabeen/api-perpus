<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/bahasa.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$bahasa = new Bahasa($db);
  
// read products will be 
// query products
$stmt = $bahasa->readBahasa();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $bahasas_arr=array();
    $bahasas_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $bahasa_item=array(
            "id_bu" => $id_bahasa,
            "bahasa" => $bahasa,
            

        );
  
        array_push($bahasas_arr["records"], $bahasa_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($bahasas_arr);
}

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No Bahasa found.")
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