<?php
class Dir{
  
    // database connection and table name
    private $conn;
    private $table_name = "dir";
  
    // object properties
    public $id_dir;
    public $id_gdiv;
    public $nama_dir;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readDir(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_dir DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createDir(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_dir=:id_dir, id_gdir=:id_gdir, nama_dir=:nama_dir";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_dir=htmlspecialchars(strip_tags($this->id_dir));
        $this->id_gdir=htmlspecialchars(strip_tags($this->id_gdir));
        $this->nama_dir=htmlspecialchars(strip_tags($this->nama_dir));

        // bind values
        $stmt->bindParam(":id_dir", $this->id_dir);
        $stmt->bindParam(":id_gdir", $this->id_gdir);
        $stmt->bindParam(":nama_dir", $this->nama_dir);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readDirPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_dir = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_dir);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_dir = $row['id_dir'];
        $this->id_gdir = $row['id_gdir'];
        $this->nama_dir = $row['nama_dir'];

    }


    // update the product
    function updateDir(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_dir = :id_dir,
                    id_gdir = :id_gdir,
                    nama_dir = :nama_dir
                WHERE
                    id_dir = :id_dir";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_dir=htmlspecialchars(strip_tags($this->id_dir));
        $this->id_gdir=htmlspecialchars(strip_tags($this->id_gdir));
        $this->nama_dir=htmlspecialchars(strip_tags($this->nama_dir));

    
        // bind new values
        $stmt->bindParam(':id_dir', $this->id_dir);
        $stmt->bindParam(':id_gdir', $this->id_gdir);
        $stmt->bindParam(':nama_dir', $this->nama_dir);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteDir(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_dir = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_dir=htmlspecialchars(strip_tags($this->id_dir));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_dir);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}

?>