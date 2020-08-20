<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/dir.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$dir = new Dir($db);
  
// set ID property of record to read
$dir->id_dir = isset($_GET['id_dir']) ? $_GET['id_dir'] : die();
  
// read the details of product to be edited
$dir->readDirPilihan();
  
if($dir->id_dir!=null){
    // create array
    $dir_arr = array(
        "id_dir" =>  $dir->id_dir,
        "id_gdir" => $dir->id_gdir,
        "nama_dir" => $dir->nama_dir
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($dir_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Dir does not exist."));
}
?>