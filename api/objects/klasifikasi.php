<?php
class Klasifikasi{
  
    // database connection and table name
    private $conn;
    private $table_name = "klasifikasi";
  
    // object properties
    public $id_klasifikasi;
    public $klasifikasi;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readKlasifikasi(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    klasifikasi ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createKlasifikasi(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_klasifikasi=:id_klasifikasi, klasifikasi=:klasifikasi";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_klasifikasi=htmlspecialchars(strip_tags($this->id_klasifikasi));
        $this->klasifikasi=htmlspecialchars(strip_tags($this->klasifikasi));
        

        // bind values
        $stmt->bindParam(":id_klasifikasi", $this->id_klasifikasi);
        $stmt->bindParam(":klasifikasi", $this->klasifikasi);
        

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readKlasifikasiPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_klasifikasi = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_klasifikasi);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_klasifikasi = $row['id_klasifikasi'];
        $this->klasifikasi = $row['klasifikasi'];
        

    }


    // update the product
    function updateKlasifikasi(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_klasifikasi = :id_klasifikasi,
                    klasifikasi = :klasifikasi
                WHERE
                    id_klasifikasi = :id_klasifikasi";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_klasifikasi=htmlspecialchars(strip_tags($this->id_klasifikasi));
        $this->klasifikasi=htmlspecialchars(strip_tags($this->klasifikasi));

    
        // bind new values
        $stmt->bindParam(':id_klasifikasi', $this->id_klasifikasi);
        $stmt->bindParam(':klasifikasi', $this->klasifikasi);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


       // delete the product
       function deleteKlasifikasi(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_klasifikasi = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_klasifikasi=htmlspecialchars(strip_tags($this->id_klasifikasi));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_klasifikasi);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}

?>