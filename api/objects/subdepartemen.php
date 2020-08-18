<?php
class Subdepartemen{
  
    // database connection and table name
    private $conn;
    private $table_name = "subdepartemen";
  
    // object properties
    public $id_subdep;
    public $id_dep;

    public $nama_subdep;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readSubdepartemen(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_subdep ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createSubdepartemen(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_subdep=:id_subdep, id_dep=:id_dep, nama_subdep=:nama_subdep";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_subdep=htmlspecialchars(strip_tags($this->id_subdep));
        $this->id_dep=htmlspecialchars(strip_tags($this->id_dep));
        $this->nama_subdep=htmlspecialchars(strip_tags($this->nama_subdep));

    
        // bind values
        $stmt->bindParam(":id_subdep", $this->id_subdep);
        $stmt->bindParam(":id_dep", $this->id_dep);
        $stmt->bindParam(":nama_subdep", $this->nama_subdep);


    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readSubdepartemenPilihan(){

        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_subdep  = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_subdep);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
        // set values to object properties
        $this->id_subdep = $row['id_subdep'];
        $this->id_dep = $row['id_dep'];
        $this->nama_subdep = $row['nama_subdep'];
 
    }


    // update the product
    function updateSubdepartemen(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_dep = :id_dep,
                    nama_subdep = :nama_subdep
                WHERE
                    id_subdep = :id_subdep";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_subdep=htmlspecialchars(strip_tags($this->id_subdep));
        $this->id_dep=htmlspecialchars(strip_tags($this->id_dep));
        $this->nama_subdep=htmlspecialchars(strip_tags($this->nama_subdep));

        
    
        // bind new values
        $stmt->bindParam(':id_subdep', $this->id_subdep);
        $stmt->bindParam(':id_dep', $this->id_dep);
        $stmt->bindParam(':nama_subdep', $this->nama_subdep);
  
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteSubdepartemen(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_subdep = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_subdep=htmlspecialchars(strip_tags($this->id_subdep));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_subdep);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}
?>