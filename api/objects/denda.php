<?php
class Denda{
  
    // database connection and table name
    private $conn;
    private $table_name = "denda";
  
    // object properties
    public $id_denda;
    public $id_peminjaman;
    public $jml_hari;
    public $total_denda;
    public $status;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readDenda(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_denda DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createDenda(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_denda=:id_denda, id_peminjaman=:id_peminjaman, jml_hari=:jml_hari, total_denda=:total_denda, status=:status";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_denda=htmlspecialchars(strip_tags($this->id_denda));
        $this->id_peminjaman=htmlspecialchars(strip_tags($this->id_peminjaman));
        $this->jml_hari=htmlspecialchars(strip_tags($this->jml_hari));
        $this->total_denda=htmlspecialchars(strip_tags($this->total_denda));
        $this->status=htmlspecialchars(strip_tags($this->status));
    
        // bind values
        $stmt->bindParam(":id_denda", $this->id_denda);
        $stmt->bindParam(":id_peminjaman", $this->id_peminjaman);
        $stmt->bindParam(":jml_hari", $this->jml_hari);
        $stmt->bindParam(":total_denda", $this->total_denda);
        $stmt->bindParam(":status", $this->status);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readDendaPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_denda = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_denda);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_denda = $row['id_denda'];
        $this->id_peminjaman = $row['id_peminjaman'];
        $this->jml_hari = $row['jml_hari'];
        $this->total_denda = $row['total_denda'];
        $this->status = $row['status'];

    }


    // update the product
    function updateDenda(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_denda = :id_denda,
                    id_peminjaman = :id_peminjaman,
                    jml_hari = :jml_hari,
                    total_denda = :total_denda,
                    status = :status
                WHERE
                    id_denda = :id_denda";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_denda=htmlspecialchars(strip_tags($this->id_denda));
        $this->id_peminjaman=htmlspecialchars(strip_tags($this->id_peminjaman));
        $this->jml_hari=htmlspecialchars(strip_tags($this->jml_hari));
        $this->total_denda=htmlspecialchars(strip_tags($this->total_denda));
        $this->status=htmlspecialchars(strip_tags($this->status));

    
        // bind new values
        $stmt->bindParam(':id_denda', $this->id_denda);
        $stmt->bindParam(':id_peminjaman', $this->id_peminjaman);
        $stmt->bindParam(':jml_hari', $this->jml_hari);
        $stmt->bindParam(':total_denda', $this->total_denda);
        $stmt->bindParam(':status', $this->status);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteDenda(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_denda = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_denda=htmlspecialchars(strip_tags($this->id_denda));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_denda);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}


?>