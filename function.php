<?php

class Peminjam {
    private $conn;
    private $tbl_peminjaman = "peminjaman";
    // private $tb_apps_nilai = "apps_nilai";
    
    public function __construct($db){
        $this->conn = $db;
    }

    function readPeminjaman(){
        $query = "SELECT *
        FROM ".$this->tbl_peminjaman."
        ";    
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        
        return $stmt;


        
            
    }
}



// class Nilai{
//     private $conn;
//     private $tb_wp_users = "wp_users";
//     private $tb_apps_nilai = "apps_nilai";
    
//     public function __construct($db){
//         $this->conn = $db;
//     }
    
//         function CreateNilai(){
//             $query = "INSERT INTO apps_nilai 
//                       SET 
//                           npm=:npm, 
//                           semester=:semester, 
//                           ip=:ip, 
//                           nip=:nip, 
//                           created_at=:created_at";
                          
//             $stmt = $this->conn->prepare($query);
            
//             $this->npm=htmlspecialchars(strip_tags($this->npm));
//             $this->semester=htmlspecialchars(strip_tags($this->semester));
//             $this->ip=htmlspecialchars(strip_tags($this->ip));
//             $this->nip=htmlspecialchars(strip_tags($this->nip));
//             $this->created_at=htmlspecialchars(strip_tags($this->created_at));
            
//             $stmt->bindParam(":npm", $this->npm);
//             $stmt->bindParam(":semester", $this->semester);
//             $stmt->bindParam(":ip", $this->ip);
//             $stmt->bindParam(":nip", $this->nip);
//             $stmt->bindParam(":created_at", $this->created_at);
            
//                 if($stmt->execute()){
//                     return true;
//                     }
//                 return false;
//             }
            
//         function ReadKemajuanStudi(){
//             $query = "SELECT a.semester, a.ip, a.nip, b.display_name 
//             FROM ".$this->tb_apps_nilai." a 
//             LEFT JOIN ".$this->tb_wp_users." b 
//             ON nip = user_login 
//             WHERE npm = ?
//             ORDER BY a.created_at ASC";
        
//             $stmt = $this->conn->prepare( $query );
         
//             $stmt->bindParam(1, $this->npm);
            
//             $stmt->execute();
            
//                 return $stmt; 
//             }
        
//         function ReadKemajuanStudiDosen(){
//             $query = "SELECT *
//             FROM ".$this->tb_apps_nilai." a, ".$this->tb_wp_users." b
//             WHERE a.npm = b.user_login
//             AND nip = ?
//             AND npm = ?
//             ORDER BY a.created_at ASC";
        
//             $stmt= $this->conn->prepare( $query );
         
//             $stmt->bindParam(1, $this->nip);
//             $stmt->bindParam(2, $this->npm);
            
//             $stmt->execute();
            
//                 return $stmt; 
//             } 
            
//         function UpdateNilai(){
//             $query = "UPDATE apps_nilai 
//                       SET 
//                           npm=:npm, 
//                           semester=:semester, 
//                           ip=:ip, 
//                           nip=:nip
//                       Where
//                           id=:id";
            
//             $stmt = $this->conn->prepare($query);
            
//             $this->id=htmlspecialchars(strip_tags($this->id));
//             $this->npm=htmlspecialchars(strip_tags($this->npm));
//             $this->semester=htmlspecialchars(strip_tags($this->semester));
//             $this->ip=htmlspecialchars(strip_tags($this->ip));
//             $this->nip=htmlspecialchars(strip_tags($this->nip));
            
//             $stmt->bindParam(':id', $this->id);
//             $stmt->bindParam(":npm", $this->npm);
//             $stmt->bindParam(":semester", $this->semester);
//             $stmt->bindParam(":ip", $this->ip);
//             $stmt->bindParam(":nip", $this->nip);
            
//                 if($stmt->execute()){
//                     return true;
//                     }
//                 return false;
//             }
        
//         function DeleteNilai(){
//             $query = "DELETE FROM apps_nilai
//             WHERE 
//             id = ?";
 
//             $stmt = $this->conn->prepare($query);
         
//             $this->id=htmlspecialchars(strip_tags($this->id));
         
//             $stmt->bindParam(1, $this->id);
         
//                 if($stmt->execute()){
//                     return true;
//                 }
             
//                 return false;
//             }
// }
?>