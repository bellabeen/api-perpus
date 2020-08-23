<?php
class Jabatan{
  
    // database connection and table name
    private $conn;
    private $table_name = "jabatan";
  
    // object properties
    public $id_jabatan;
    public $nama_jabatan;


  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readJabatan(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    nama_jabatan ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createJabatan(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_jabatan=:id_jabatan, nama_jabatan=:nama_jabatan";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_jabatan=htmlspecialchars(strip_tags($this->id_jabatan));
        $this->nama_jabatan=htmlspecialchars(strip_tags($this->nama_jabatan));
        
    
        // bind values
        $stmt->bindParam(":id_jabatan", $this->id_jabatan);
        $stmt->bindParam(":nama_jabatan", $this->nama_jabatan);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readJabatanPilihan(){

        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_jabatan  = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_jabatan);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
        // set values to object properties
        $this->id_jabatan = $row['id_jabatan'];
        $this->nama_jabatan = $row['nama_jabatan'];
        
    }


       // update the product
       function updateJabatan(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_jabatan = :id_jabatan,
                    nama_jabatan = :nama_jabatan
                    
                WHERE
                    id_jabatan = :id_jabatan";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_jabatan=htmlspecialchars(strip_tags($this->id_jabatan));
        $this->nama_jabatan=htmlspecialchars(strip_tags($this->nama_jabatan));
    
        // bind new values
        $stmt->bindParam(':id_jabatan', $this->id_jabatan);
        $stmt->bindParam(':nama_jabatan', $this->nama_jabatan);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function deleteJabatan(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_jabatan = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_jabatan=htmlspecialchars(strip_tags($this->id_jabatan));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_jabatan);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}
?>