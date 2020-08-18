<?php
class Bahasa{
  
    // database connection and table name
    private $conn;
    private $table_name = "bahasa";
  
    // object properties
    public $id_bahasa;
    public $bahasa;


  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readBahasa(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_bahasa ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createBahasa(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_bahasa=:id_bahasa, bahasa=:bahasa";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_bahasa=htmlspecialchars(strip_tags($this->id_bahasa));
        $this->bahasa=htmlspecialchars(strip_tags($this->bahasa));
        
    
        // bind values
        $stmt->bindParam(":id_bahasa", $this->id_bahasa);
        $stmt->bindParam(":bahasa", $this->bahasa);
        


    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readBahasaPilihan(){

        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_bahasa  = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_bahasa);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
        // set values to object properties
        $this->id_bahasa = $row['id_bahasa'];
        $this->bahasa = $row['bahasa'];
        

    }


       // update the product
       function updateBahasa(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_bahasa = :id_bahasa,
                    bahasa = :bahasa
                    
                WHERE
                    id_bahasa = :id_bahasa";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_bahasa=htmlspecialchars(strip_tags($this->id_bahasa));
        $this->bahasa=htmlspecialchars(strip_tags($this->bahasa));


    
        // bind new values
        $stmt->bindParam(':id_bahasa', $this->id_bahasa);
        $stmt->bindParam(':bahasa', $this->bahasa);


    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function deleteBahasa(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_bahasa = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_bahasa=htmlspecialchars(strip_tags($this->id_bahasa));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_bahasa);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}
?>