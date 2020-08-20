<?php
class Penerbit{
  
    // database connection and table name
    private $conn;
    private $table_name = "penerbit";
  
    // object properties
    public $id_penerbit;
    public $nama_penerbit;
    public $kota_terbit;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readPenerbit(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    nama_penerbit DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createPenerbit(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_penerbit=:id_penerbit, nama_penerbit=:nama_penerbit, kota_terbit=:kota_terbit";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_penerbit=htmlspecialchars(strip_tags($this->id_penerbit));
        $this->nama_penerbit=htmlspecialchars(strip_tags($this->nama_penerbit));
        $this->kota_terbit=htmlspecialchars(strip_tags($this->kota_terbit));

        // bind values
        $stmt->bindParam(":id_penerbit", $this->id_Penerbit);
        $stmt->bindParam(":nama_penerbit", $this->nama_penerbit);
        $stmt->bindParam(":kota_terbit", $this->kota_terbit);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readPenerbitPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_penerbit = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_penerbit);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_penerbit = $row['id_penerbit'];
        $this->nama_penerbit = $row['nama_penerbit'];
        $this->kota_terbit = $row['kota_terbit'];

    }


    // update the product
    function updatePenerbit(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_penerbit = :id_penerbit,
                    nama_penerbit = :nama_penerbit,
                    kota_terbit = :kota_terbit
                WHERE
                    id_penerbit = :id_penerbit";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_penerbit=htmlspecialchars(strip_tags($this->id_penerbit));
        $this->nama_penerbit=htmlspecialchars(strip_tags($this->nama_penerbit));
        $this->kota_terbit=htmlspecialchars(strip_tags($this->kota_terbit));

    
        // bind new values
        $stmt->bindParam(':id_penerbit', $this->id_penerbit);
        $stmt->bindParam(':nama_penerbit', $this->nama_penerbit);
        $stmt->bindParam(':kota_terbit', $this->kota_terbit);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deletePenerbit(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_penerbit = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_penerbit=htmlspecialchars(strip_tags($this->id_penerbit));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_penerbit);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}

?>