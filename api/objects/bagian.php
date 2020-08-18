<?php
class Bagian{
  
    // database connection and table name
    private $conn;
    private $table_name = "bagian";
  
    // object properties
    public $id_bag;
    public $id_subdep;
    public $nama_bag;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readBagian(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_bag ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createBagian(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_bag=:id_bag, id_subdep=:id_subdep, nama_bagian=:nama_bagian";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_bag=htmlspecialchars(strip_tags($this->id_bag));
        $this->id_subdep=htmlspecialchars(strip_tags($this->id_subdep));
        $this->nama_bag=htmlspecialchars(strip_tags($this->nama_bag));

    
        // bind values
        $stmt->bindParam(":id_bag", $this->id_bag);
        $stmt->bindParam(":id_subdep", $this->id_subdep);
        $stmt->bindParam(":nama_bag", $this->nama_bag);


    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readBagianPilihan(){

        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_bag  = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_bag);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
        // set values to object properties
        $this->id_bag = $row['id_bag'];
        $this->id_subdep = $row['id_subdep'];
        $this->nama_bag = $row['nama_bag'];
 
    }


    // update the product
    function updateBagian(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_subdep = :id_subdep,
                    nama_bag = :nama_bag
                WHERE
                    id_bag = :id_bag";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_subdep=htmlspecialchars(strip_tags($this->id_subdep));
        $this->nama_bag=htmlspecialchars(strip_tags($this->nama_bag));

        
    
        // bind new values
        $stmt->bindParam(':id_subdep', $this->id_subdep);
        $stmt->bindParam(':nama_bag', $this->nama_bag);
  
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteBagian(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_bag = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_bag=htmlspecialchars(strip_tags($this->id_bag));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_bag);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}
?>