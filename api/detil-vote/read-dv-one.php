<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/detil-vote.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$dv = new DetilVote($db);
  
// set ID property of record to read
$dv->id_vote = isset($_GET['id_vote']) ? $_GET['id_vote'] : die();
  
// read the details of product to be edited
$dv->readDetilVotePilihan();
  
if($dv->id_vote!=null){
    // create array
    $dv_arr = array(
        "id_vote" =>  $dv->id_vote,
        "id_request" => $dv->id_request,
        "indeks" => $dv->indeks
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($dv_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Detil Vote does not exist."));
}
?>