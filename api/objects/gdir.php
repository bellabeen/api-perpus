<?php
class Gdir{
  
    // database connection and table name
    private $conn;
    private $table_name = "gdir";
  
    // object properties
    public $id_gdir;
    public $id_bu;
    public $nama_gdir;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readGdir(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_gdir DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createGdir(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_gdir=:id_gdir, id_bu=:id_bu, nama_gdir=:nama_gdir";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_gdir=htmlspecialchars(strip_tags($this->id_gdir));
        $this->id_bu=htmlspecialchars(strip_tags($this->id_bu));
        $this->nama_gdir=htmlspecialchars(strip_tags($this->nama_gdir));

        // bind values
        $stmt->bindParam(":id_gdir", $this->id_gdir);
        $stmt->bindParam(":id_bu", $this->id_bu);
        $stmt->bindParam(":nama_gdir", $this->nama_gdir);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readGdirPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_gdir = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_gdir);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_gdir = $row['id_gdir'];
        $this->id_bu = $row['id_bu'];
        $this->nama_gdir = $row['nama_gdir'];

    }


    // update the product
    function updateGdir(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_gdir = :id_gdir,
                    id_bu = :id_bu,
                    nama_gdir = :nama_gdir
                WHERE
                    id_gdir = :id_gdir";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_gdir=htmlspecialchars(strip_tags($this->id_gdir));
        $this->id_bu=htmlspecialchars(strip_tags($this->id_bu));
        $this->nama_gdir=htmlspecialchars(strip_tags($this->nama_gdir));

    
        // bind new values
        $stmt->bindParam(':id_gdir', $this->id_gdir);
        $stmt->bindParam(':id_bu', $this->id_bu);
        $stmt->bindParam(':nama_gdir', $this->nama_gdir);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteGdir(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_gdir = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_gdir=htmlspecialchars(strip_tags($this->id_gdir));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_gdir);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}

?>