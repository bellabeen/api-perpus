<?php
class Kontrak{
  
    // database connection and table name
    private $conn;
    private $table_name = "kontrak";
  
    // object properties
    public $id_kontrak;
    public $nama_kontrak;


  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readKontrak(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    nama_kontrak ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createKontrak(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_kontrak=:id_kontrak, nama_kontrak=:nama_kontrak";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_kontrak=htmlspecialchars(strip_tags($this->id_kontrak));
        $this->nama_kontrak=htmlspecialchars(strip_tags($this->nama_kontrak));
        
    
        // bind values
        $stmt->bindParam(":id_kontrak", $this->id_kontrak);
        $stmt->bindParam(":nama_kontrak", $this->nama_kontrak);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readKontrakPilihan(){

        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_kontrak  = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_kontrak);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
        // set values to object properties
        $this->id_kontrak = $row['id_kontrak'];
        $this->nama_kontrak = $row['nama_kontrak'];
        
    }


       // update the product
       function updateKontrak(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_kontrak = :id_kontrak,
                    nama_kontrak = :nama_kontrak
                    
                WHERE
                    id_kontrak = :id_kontrak";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_kontrak=htmlspecialchars(strip_tags($this->id_kontrak));
        $this->nama_kontrak=htmlspecialchars(strip_tags($this->nama_kontrak));
    
        // bind new values
        $stmt->bindParam(':id_kontrak', $this->id_kontrak);
        $stmt->bindParam(':nama_kontrak', $this->nama_kontrak);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function deleteKontrak(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_kontrak = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_kontrak=htmlspecialchars(strip_tags($this->id_kontrak));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_kontrak);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}
?>