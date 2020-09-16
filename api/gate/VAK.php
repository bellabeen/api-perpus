<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/anggota.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$anggota = new Anggota($db);

if(isset($_POST['indeks']) && isset($_POST['kata_sandi'])) {
    $indeks = htmlspecialchars($_POST['indeks']);
    $kata_sandi = htmlspecialchars($_POST['kata_sandi']);

    $encrypted_password = hash("md5", $kata_sandi);
    $sql = $anggota->loginAnggota($indeks, $encrypted_password);

    if(mysqli_num_rows($sql) > 0) {
        while($row = $sql->fetch_array()){
            $response["error"] = FALSE;
            $response["message"] = "Login Successfull";
            $response["data"]["indeks"] = $row['indeks'];
            $response["data"]["kata_sandi"] = $row['kata_sandi'];
        }
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        $response["message"] = "Incorrect Email or Password";
        echo json_encode($response);
    }
}

// // set ID property of record to read
// $anggota->indeks = isset($_GET['indeks']) ? $_GET['indeks'] : die();
  
// // read the details of product to be edited
// $anggota->loginAnggota($indeks, $kata_sandi);
  
// if($anggota->hp!=null){
//     // create array
//     $anggota_arr = array(
//         "indeks" =>  $anggota->indeks,
//         "hp" => $anggota->hp,
//         "email" => $anggota->email,
//         "tanggal_daftar" => $anggota->tanggal_daftar,
//         "kata_sandi" => $anggota->kata_sandi,
//         "foto" => $anggota->foto,
//         "status" => $anggota->status,
//         "id_sesi" => $anggota->id_sesi,
//         "lastlogin" => $anggota->lastlogin,
//         "host" => $anggota->host
  
//     );
  
//     // set response code - 200 OK
//     http_response_code(200);
  
//     // make it json format
//     echo json_encode($anggota_arr);
// }
  
// else{
//     // set response code - 404 Not found
//     http_response_code(503);
  
//     // tell the user product does not exist
//     echo json_encode(array("message" => "Incoreect Email or Password"));
// }
?>





<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/anggota.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$anggota = new Anggota($db);

if(isset($_POST['indeks']) && isset($_POST['kata_sandi'])) {
    $indeks = htmlspecialchars($_POST['indeks']);
    $kata_sandi = htmlspecialchars($_POST['kata_sandi']);

    $encrypted_password = hash("md5", $kata_sandi);
    $sql = $anggota->loginAnggota($indeks, $encrypted_password);

    if(mysqli_num_rows($sql) > 0) {
        while($row = $sql->fetch_array()){
            $response["error"] = FALSE;
            $response["message"] = "Login Successfull";
            $response["data"]["indeks"] = $row['indeks'];
            $response["data"]["kata_sandi"] = $row['kata_sandi'];
        }
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        $response["message"] = "Incorrect Email or Password";
        echo json_encode($response);
    }
}

// // set ID property of record to read
// $anggota->indeks = isset($_GET['indeks']) ? $_GET['indeks'] : die();
  
// // read the details of product to be edited
// $anggota->loginAnggota($indeks, $kata_sandi);
  
// if($anggota->hp!=null){
//     // create array
//     $anggota_arr = array(
//         "indeks" =>  $anggota->indeks,
//         "hp" => $anggota->hp,
//         "email" => $anggota->email,
//         "tanggal_daftar" => $anggota->tanggal_daftar,
//         "kata_sandi" => $anggota->kata_sandi,
//         "foto" => $anggota->foto,
//         "status" => $anggota->status,
//         "id_sesi" => $anggota->id_sesi,
//         "lastlogin" => $anggota->lastlogin,
//         "host" => $anggota->host
  
//     );
  
//     // set response code - 200 OK
//     http_response_code(200);
  
//     // make it json format
//     echo json_encode($anggota_arr);
// }
  
// else{
//     // set response code - 404 Not found
//     http_response_code(503);
  
//     // tell the user product does not exist
//     echo json_encode(array("message" => "Incoreect Email or Password"));
// }
?>




<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
// include_once '../objects/anggota.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object


if ($_SERVER['REQUEST_METHOD']=='POST') {

    $indeks = $_POST['indeks'];
    $kata_sandi = $_POST['kata_sandi'];

    require_once '../config/database.php';
    $database = new Database();
    $db = $database->getConnection();

    $sql = "SELECT * FROM anggota WHERE indeks='$indeks' ";

    $response = mysqli_query($db, $sql);

    $result = array();
    $result['login'] = array();
    
    if ( mysqli_num_rows($response) === 1 ) {
        
        $row = mysqli_fetch_assoc($response);

        if ( password_verify($password, $row['kata_sandi']) ) {
            
            $index['indeks'] = $row['indeks'];
            $index['email'] = $row['email'];
            $index['status'] = $row['status'];

            array_push($result['login'], $index);

            $result['success'] = "1";
            $result['message'] = "success";
            
            echo json_encode($result);

            mysqli_close($db);

        } else {

            $result['success'] = "0";
            $result['message'] = "error";
            echo json_encode($result);

            mysqli_close($db);

        }

    }

}

?>




<?php
class Login{
  
    // database connection and table name
    private $conn;
    private $table_name = "anggota";
  
    // object properties
    public $indeks;
    public $hp;
    public $email;
    public $tanggal_daftar;
    public $kata_sandi;
    public $foto;
    public $status;
    public $id_sesi;
    public $lastlogin;
    public $host;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // function loginAnggota($indeks, $kata_sandi){
    //     // query to read single record
    //     $query = "SELECT * FROM " . $this->table_name;
    //     $query .=" WHERE indeks='".$indeks."' AND kata_sandi='".$kata_sandi."'";
    
    //     // prepare query statement
    //     $stmt = $this->conn->prepare( $query );
    
    //     // bind id of product to be updated
    //     $stmt->bindParam(1, $this->indeks);
    
    //     // execute query
    //     $stmt->execute();
    
    //     // get retrieved row
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);



public function getAnggotaByIndeksKataSandi($indeks, $kata_sandi) {
    $query = "SELECT * FROM " . $this->table_name;
    $query .=" WHERE indeks = ? ";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam("s", $indeks);

    if($stmt->execute()){
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();


        $kata_sandi_db = $user['kata_sandi'];
        $hash = $this->checkhashMD5($kata_sandi);
        echo $kata_sandi_db;
        echo $hash;
        echo "Hello World";
        if ($kata_sandi_db == $hash){
            
            return $user;
        }
    }

    // $stmt = $this->conn->prepare("SELECT * FROM anggota WHERE indeks = ?");
    // $stmt->bind_param("s", $indeks);



    // if ($stmt->execute()) {
    //     $user = $stmt->get_result()->fetch_assoc();
    //     $stmt->close();
    //     // verifikasi password user
    //     // $salt = $user['salt'];
    //     $kata_sandi = $user['kata_sandi'];
    //     $hash = $this->checkhashMD5($kata_sandi);
    //     // cek password jika sesuai
    //     if ($kata_sandi == $hash) {
    //         // autentikasi user berhasil
    //         return $user;
    //     }
    // } else {
    //     return NULL;
    // }
    
}

// public function hashSSHA($password) {
//     $salt = sha1(rand());
//     $salt = substr($salt, 0, 10);
//     $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
//     $hash = array("salt" => $salt, "encrypted" => $encrypted);
//     return $hash;
// }
/**
 * Decrypting password
 * @param salt, password
 * returns hash string
 */
public function checkhashMD5($kata_sandi) {
    $hash = md5($kata_sandi);
    return $hash;
}
    
}
?>