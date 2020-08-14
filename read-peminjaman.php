<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
$server=1;


include_once './api/config/database.php';
include_once 'function.php';

//class dari database
$database = new Database();
$db = $database->getConnection();

//class dari Peminjam
$peminjam = new Peminjam($db);

$peminjam->readPeminjaman();
$peminjam->id_peminjaman = isset($_GET['id_peminjaman']) ? $_GET['id_peminjaman'] : die();

//function dari peminjam
$stmt = $peminjam->readPeminjaman();

if ($server==1){
    
    $num = $stmt->rowCount();
    
        if($num>0 && $peminjam->id_peminjaman!=null){
          
            $peminjam_array=array();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
             
                    $peminjam_item = array(
                        "id_peminjaman"=>$id_peminjaman,
                        "id_buku"=>$id_buku,
                        "id_peminjam"=>$id_peminjam,
                        "tanggal_pesan"=>$tanggal_pesan,
                        "jam_pesan" =>$jam_pesan,
                        "expired_date"=>$expired_date,
                        "tanggal_pinjam"=>$tanggal_pinjam,
                        "batas_kembali"=>$batas_kembali,
                        "tanggal_pengembalian"=>$tanggal_pengembalian,
                        "status"=>$status,
                        "PP"=>$PP
                        );
                        
                        array_push($peminjam_array, $peminjam_item);
                    }
                    http_response_code(200);
            
                    echo json_encode(array("error"=>false,
                    "response_code"=>200,
                    "total_records"=>$num,
                    "records" => $peminjam_array));
                }
        
        else{
            http_response_code(404);
            echo json_encode(
            array("error"=>true,
            "response_code"=>404,
            "total_records"=>$num,
            "message"=>"No Peminjaman found.")
        );
    }
}

else {
    http_response_code(500);
        echo json_encode(
            array("error"=>true,
            "response_code"=>500,
            "total_records"=>$num,
            "message"=>"Server Error")
        );  
}
?>