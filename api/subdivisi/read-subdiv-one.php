<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/subdivisi.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$subdivisi = new Subdivisi($db);
  
// set ID property of record to read
$subdivisi->id_subdiv = isset($_GET['id_subdiv']) ? $_GET['id_subdiv'] : die();
  
// read the details of product to be edited
$subdivisi->readSubdivPilihan();
  
if($subdivisi->id_subdiv!=null){
    // create array
    $subdivisi_arr = array(
        "id_subdiv" =>  $subdivisi->id_subdiv,
        "id_div" => $subdivisi->id_div,
        "nama_subdiv" => $subdivisi->nama_subdiv
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($subdivisi_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Subdivisi does not exist."));
}
?>