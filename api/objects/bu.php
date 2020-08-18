<?php
class Bu{
  
    // database connection and table name
    private $conn;
    private $table_name = "bu";
  
    // object properties
    public $id_bu;
    public $nama_bu;
    public $sing;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readBu(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_bu DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createBu(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_bu=:id_bu, nama_bu=:nama_bu, sing=:sing";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_bu=htmlspecialchars(strip_tags($this->id_bu));
        $this->nama_bu=htmlspecialchars(strip_tags($this->nama_bu));
        $this->sing=htmlspecialchars(strip_tags($this->sing));

    
        // bind values
        $stmt->bindParam(":id_bu", $this->id_bu);
        $stmt->bindParam(":nama_bu", $this->nama_bu);
        $stmt->bindParam(":sing", $this->sing);


    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readBuPilihan(){

        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_bu  = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_bu);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
        // set values to object properties
        $this->id_bu = $row['id_bu'];
        $this->nama_bu = $row['nama_bu'];
        $this->sing = $row['sing'];

    }


       // update the product
       function updateBu(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_bu = :id_bu,
                    nama_bu = :nama_bu,
                    sing = :sing
                WHERE
                    id_bu = :id_bu";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_bu=htmlspecialchars(strip_tags($this->id_bu));
        $this->nama_bu=htmlspecialchars(strip_tags($this->nama_bu));
        $this->sing=htmlspecialchars(strip_tags($this->sing));

    
        // bind new values
        $stmt->bindParam(':id_bu', $this->id_bu);
        $stmt->bindParam(':nama_bu', $this->nama_bu);
        $stmt->bindParam(':sing', $this->sing);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function deleteBu(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_bu = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_bu=htmlspecialchars(strip_tags($this->id_bu));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_bu);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}
?>