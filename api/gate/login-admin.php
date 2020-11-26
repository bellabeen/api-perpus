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
$login->username = isset($_GET['username']) ? $_GET['username'] : die();
$login->password = md5(isset($_GET['password']) ? $_GET['password'] : die());

$stmt = $login->loginAdmin();
if($stmt->rowCount() > 0) {
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // create array
    $login_arr = array(
        "status" => true,
        "message" => "Successfully Login!",
        "username" => $row['username'],
        "nama" => $row['nama'],
        "email" => $row['email'],
        'hp' => $row['hp'],
        'foto' => $row['foto'],
        'id_sesi' => $row['id_sesi']
    );
} else {
    $login_arr = array (
        "status" => false,
        "message" => "Invalid Username or Password",
    );
}

// make it json format
// echo json_encode($login_arr);
print_r(json_encode($login_arr));


?>