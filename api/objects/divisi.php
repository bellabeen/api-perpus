<?php
class Divisi{
  
    // database connection and table name
    private $conn;
    private $table_name = "divisi";
  
    // object properties
    public $id_dir;
    public $id_div;
    public $nama_div;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readDivisi(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_div DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createDivisi(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_div=:id_div, id_dir=:id_dir, nama_div=:nama_div";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_div=htmlspecialchars(strip_tags($this->id_div));
        $this->id_dir=htmlspecialchars(strip_tags($this->id_dir));
        $this->nama_div=htmlspecialchars(strip_tags($this->nama_div));

        // bind values
        $stmt->bindParam(":id_div", $this->id_div);
        $stmt->bindParam(":id_dir", $this->id_dir);
        $stmt->bindParam(":nama_div", $this->nama_div);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readDivisiPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_div = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_div);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_div = $row['id_div'];
        $this->id_dir = $row['id_dir'];
        $this->nama_div = $row['nama_div'];

    }


    // update the product
    function updateDivisi(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_div = :id_div,
                    id_dir = :id_dir,
                    nama_div = :nama_div
                WHERE
                    id_div = :id_div";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_div=htmlspecialchars(strip_tags($this->id_div));
        $this->id_dir=htmlspecialchars(strip_tags($this->id_dir));
        $this->nama_div=htmlspecialchars(strip_tags($this->nama_div));

    
        // bind new values
        $stmt->bindParam(':id_div', $this->id_div);
        $stmt->bindParam(':id_dir', $this->id_dir);
        $stmt->bindParam(':nama_div', $this->nama_div);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteDivisi(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_div = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_div=htmlspecialchars(strip_tags($this->id_div));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_div);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}


?>