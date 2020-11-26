<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
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
$login->indeks = isset($_POST['indeks']) ? $_POST['indeks'] : die();
$login->kata_sandi = md5(isset($_POST['kata_sandi']) ? $_POST['kata_sandi'] : die());

$stmt = $login->login();
if($stmt->rowCount() > 0) {
    $login_arr = array(
        "status" => true,
        "message" => "Successfully Login!",
    );
    $login_arr["data"] = null;
    // $login_arr["records"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $login_item = array(
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

        $login_arr ["data"] = $login_item;
    }
    http_response_code(200);

    echo json_encode($login_arr);
} else {
    http_response_code(503);
    echo json_encode(
        array(
            "status" => false,
            "message" => "Invalid Indeks or Password"
            )
    );
}


// if($stmt->rowCount() > 0) {
//     // get retrieved row
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);

//     // create array
//     $login_arr = array(
//         "status" => true,
//         "message" => "Successfully Login!",
//         "indeks" => $row['indeks'],
//         "hp" => $row['hp'],
//         "email" => $row['email'],
//         "tangggal_daftar" => $row['tanggal_daftar'],
//         "foto" => $row['foto'],
//         "status_id" => $row['status'],
//         "id_sesi" => $row['id_sesi'],
//         'lastlogin' => $row['lastlogin'],
//         'host' => $row['host']
        
//     );
// } else {
//     $login_arr = array (
//         "status" => false,
//         "message" => "Invalid Indeks or Password",
//     );
// }

// make it json format
// echo json_encode($login_arr);
// print_r(json_encode($login_arr));
?>