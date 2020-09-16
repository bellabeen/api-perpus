<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/login.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$login = new Login($db);

//set ID property
$login->indeks = isset($_GET['indeks']) ? $_GET['indeks'] : die();
$login->kata_sandi = md5(isset($_GET['kata_sandi']) ? $_GET['kata_sandi'] : die());

$stmt = $login->login();
if($stmt->rowCount() > 0) {
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // create array
    $login_arr = array(
        "status" => true,
        "message" => "Successfully Login!",
        "indeks" => $row['indeks'],
        "email" => $row['email']
    );
} else {
    $login_arr = array (
        "status" => false,
        "message" => "Invalid Indeks or Password",
    );
}

// make it json format
// echo json_encode($login_arr);
print_r(json_encode($login_arr));


?>