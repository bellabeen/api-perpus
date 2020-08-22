<?php
class Request{
  
    // database connection and table name
    private $conn;
    private $table_name = "request";
  
    // object properties
    public $id_request;
    public $judul;
    public $pengarang;
    public $penerbit;
    public $requester;
    public $tgl;
    public $status;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readRequest(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_request DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

     // create product
     function createRequest(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_request=:id_request, judul=:judul, pengarang=:pengarang, penerbit=:penerbit,
                    requester=:requester, tgl=:tgl, status=:status";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_request=htmlspecialchars(strip_tags($this->id_request));
        $this->judul=htmlspecialchars(strip_tags($this->judul));
        $this->pengarang=htmlspecialchars(strip_tags($this->pengarang));
        $this->penerbit=htmlspecialchars(strip_tags($this->penerbit));
        $this->requester=htmlspecialchars(strip_tags($this->requester));
        $this->tgl=htmlspecialchars(strip_tags($this->tgl));
        $this->status=htmlspecialchars(strip_tags($this->status));
        
    
        // bind values
        $stmt->bindParam(":id_request", $this->id_request);
        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":pengarang", $this->pengarang);
        $stmt->bindParam(":penerbit", $this->penerbit);
        $stmt->bindParam(":requester", $this->requester);
        $stmt->bindParam(":tgl", $this->tgl);
        $stmt->bindParam(":status", $this->status);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readRequestPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_request  = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_request);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
        // set values to object properties
        $this->id_request = $row['id_request'];
        $this->judul = $row['judul'];
        $this->pengarang = $row['pengarang'];
        $this->penerbit = $row['penerbit'];
        $this->requester = $row['requester'];
        $this->tgl = $row['tgl'];
        $this->status = $row['status'];
    }


       // update the product
       function updateRequest(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_request = :id_request,
                    judul = :judul,
                    pengarang = :pengarang,
                    penerbit = :penerbit,
                    requester = :requester,
                    tgl = :tgl,
                    status = :status
                WHERE
                    id_request = :id_request";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_request=htmlspecialchars(strip_tags($this->id_request));
        $this->judul=htmlspecialchars(strip_tags($this->judul));
        $this->pengarang=htmlspecialchars(strip_tags($this->pengarang));
        $this->penerbit=htmlspecialchars(strip_tags($this->penerbit));
        $this->requester=htmlspecialchars(strip_tags($this->requester));
        $this->tgl=htmlspecialchars(strip_tags($this->tgl));
        $this->status=htmlspecialchars(strip_tags($this->status));
    
        // bind new values
        $stmt->bindParam(':id_request', $this->id_request);
        $stmt->bindParam(':judul', $this->judul);
        $stmt->bindParam(':pengarang', $this->pengarang);
        $stmt->bindParam(':penerbit', $this->penerbit);
        $stmt->bindParam(':requester', $this->requester);
        $stmt->bindParam(':tgl', $this->tgl);
        $stmt->bindParam(':status', $this->status);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function deleteRequest(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_request = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_request=htmlspecialchars(strip_tags($this->id_request));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_request);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}
?>