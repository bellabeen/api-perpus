<?php

include_once 'connect.php';

$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {
 
 $email = htmlspecialchars($_POST['email']);
 $password = htmlspecialchars($_POST['password']);

 $encrypted_password = hash("sha256", $password);// encrypted password
        
 $sql = $MySQLiconn->query("SELECT * FROM users WHERE email='$email' AND password='$encrypted_password'");

 if(mysqli_num_rows($sql) > 0){
  while($row = $sql->fetch_array()){
   $response["error"] = FALSE;
       $response["message"] = "Login Successfull";
       $response["data"]["firstname"] = $row['firstname'];
       $response["data"]["lastname"] = $row['lastname'];
       $response["data"]["email"] = $row['email'];
      }

  echo json_encode($response);
   }else{
    $response["error"] = TRUE;
     $response["message"] = "Incorrect Email or Password!";

  echo json_encode($response);
   }
}

function getBukuPilihan($kode_buku){
    // return "test";
    $kueri = "SELECT * FROM ".$this->table_name1;
    $kueri .=" WHERE kode_buku='".$kode_buku."'";
    $hasil = $this->db->query($kueri) or die ("Error ".$this->db->connect_error);
    http_response_code(200);
    $data = array();
    while ($row = $hasil->fetch_assoc()){
        $data[]=$row;
    }
    if (count($data)==0)
        return array("msg"=>"Data tidak ada ", "data"=>array());
    return array("msg"=>"success", "data"=>$data);
}

?>
