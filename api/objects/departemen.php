<?php
class Departemen{
  
    // database connection and table name
    private $conn;
    private $table_name = "departemen";
  
    // object properties
    public $id_dep;
    public $id_subdiv;
    public $nama_dep;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readDepartemen(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_dep DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createDepartemen(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_dep=:id_dep, id_subdiv=:id_subdiv, nama_dep=:nama_dep";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_dep=htmlspecialchars(strip_tags($this->id_dep));
        $this->id_subdiv=htmlspecialchars(strip_tags($this->id_subdiv));
        $this->nama_dep=htmlspecialchars(strip_tags($this->nama_dep));

    
        // bind values
        $stmt->bindParam(":id_dep", $this->id_dep);
        $stmt->bindParam(":id_subdiv", $this->id_subdiv);
        $stmt->bindParam(":nama_dep", $this->nama_dep);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readDepartemenPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_dep = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_dep);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_dep = $row['id_dep'];
        $this->id_subdiv = $row['id_subdiv'];
        $this->nama_dep = $row['nama_dep'];

    }


    // update the product
    function updateDepartemen(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_dep = :id_dep,
                    id_subdiv = :id_subdiv,
                    nama_dep = :nama_dep
                WHERE
                    id_dep = :id_dep";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_dep=htmlspecialchars(strip_tags($this->id_dep));
        $this->id_subdiv=htmlspecialchars(strip_tags($this->id_subdiv));
        $this->nama_dep=htmlspecialchars(strip_tags($this->nama_dep));

    
        // bind new values
        $stmt->bindParam(':id_dep', $this->id_dep);
        $stmt->bindParam(':id_subdiv', $this->id_subdiv);
        $stmt->bindParam(':nama_dep', $this->nama_dep);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteDepartemen(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_dep = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_dep=htmlspecialchars(strip_tags($this->id_dep));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_dep);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}


?>