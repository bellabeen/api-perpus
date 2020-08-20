<?php
class DetilPengarang{
  
    // database connection and table name
    private $conn;
    private $table_name = "detil_pengarang";
  
    // object properties
    public $id_detil;
    public $id_buku;
    public $id_pengarang;
    public $ket;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readDetilPengarang(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_detil DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createDetilPengarang(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_detil=:id_detil, id_buku=:id_buku, id_pengarang=:id_pengarang, ket=:ket";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_detil=htmlspecialchars(strip_tags($this->id_detil));
        $this->id_buku=htmlspecialchars(strip_tags($this->id_buku));
        $this->id_pengarang=htmlspecialchars(strip_tags($this->id_pengarang));
        $this->ket=htmlspecialchars(strip_tags($this->ket));
    
        // bind values
        $stmt->bindParam(":id_detil", $this->id_detil);
        $stmt->bindParam(":id_buku", $this->id_buku);
        $stmt->bindParam(":id_pengarang", $this->id_pengarang);
        $stmt->bindParam(":ket", $this->ket);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readDetilPengarangPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_detil = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_detil);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_detil = $row['id_detil'];
        $this->id_buku = $row['id_buku'];
        $this->id_pengarang = $row['id_pengarang'];
        $this->ket = $row['ket'];


    }


    // update the product
    function updateDetilPengarang(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_detil = :id_detil,
                    id_buku = :id_buku,
                    id_pengarang = :id_pengarang,
                    ket = :ket
                WHERE
                    id_detil = :id_detil";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_detil=htmlspecialchars(strip_tags($this->id_detil));
        $this->id_buku=htmlspecialchars(strip_tags($this->id_buku));
        $this->id_pengarang=htmlspecialchars(strip_tags($this->id_pengarang));
        $this->ket=htmlspecialchars(strip_tags($this->ket));


    
        // bind new values
        $stmt->bindParam(':id_detil', $this->id_detil);
        $stmt->bindParam(':id_buku', $this->id_buku);
        $stmt->bindParam(':id_pengarang', $this->id_pengarang);
        $stmt->bindParam(':ket', $this->ket);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteDetilPengarang(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_detil = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_detil=htmlspecialchars(strip_tags($this->id_detil));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_detil);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}


?>