<?php
class Subdivisi{
  
    // database connection and table name
    private $conn;
    private $table_name = "subdivisi";
  
    // object properties
    public $id_subdiv;
    public $id_div;
    public $nama_subdiv;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readSubdiv(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_subdiv DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createSubdiv(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_subdiv=:id_subdiv, id_div=:id_div, nama_subdiv=:nama_subdiv";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_subdiv=htmlspecialchars(strip_tags($this->id_subdiv));
        $this->id_div=htmlspecialchars(strip_tags($this->id_div));
        $this->nama_subdiv=htmlspecialchars(strip_tags($this->nama_subdiv));

        // bind values
        $stmt->bindParam(":id_subdiv", $this->id_subdivisi);
        $stmt->bindParam(":id_div", $this->id_div);
        $stmt->bindParam(":nama_subdiv", $this->nama_subdiv);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readSubdivPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_subdiv = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_subdiv);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_subdiv = $row['id_subdiv'];
        $this->id_div = $row['id_div'];
        $this->nama_subdiv = $row['nama_subdiv'];

    }


    // update the product
    function updateSubdiv(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_subdiv = :id_subdiv,
                    id_div = :id_div,
                    nama_subdiv = :nama_subdiv
                WHERE
                    id_subdiv = :id_subdiv";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_subdiv=htmlspecialchars(strip_tags($this->id_subdiv));
        $this->id_div=htmlspecialchars(strip_tags($this->id_div));
        $this->nama_subdiv=htmlspecialchars(strip_tags($this->nama_subdiv));

    
        // bind new values
        $stmt->bindParam(':id_subdiv', $this->id_subdiv);
        $stmt->bindParam(':id_div', $this->id_div);
        $stmt->bindParam(':nama_subdiv', $this->nama_subdiv);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteSubdiv(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_subdiv = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_subdiv=htmlspecialchars(strip_tags($this->id_subdiv));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_subdiv);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}


?>