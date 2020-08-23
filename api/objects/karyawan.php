<?php
class Karyawan{
  
    // database connection and table name
    private $conn;
    private $table_name = "karyawan";
  
    // object properties
    public $indeks;
    public $nama;
    public $bagian;
    public $jabatan;
    public $kontrak;
    public $jenis_kelamin;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readKaryawan(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    nama ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createKaryawan(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    indeks=:indeks, nama=:nama, bagian=:bagian, jabatan=:jabatan, kontrak=:kontrak, jenis_kelamin=:jenis_kelamin";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->indeks=htmlspecialchars(strip_tags($this->indeks));
        $this->nama=htmlspecialchars(strip_tags($this->nama));
        $this->bagian=htmlspecialchars(strip_tags($this->bagian));
        $this->jabatan=htmlspecialchars(strip_tags($this->jabatan));
        $this->kontrak=htmlspecialchars(strip_tags($this->kontrak));
        $this->jenis_kelamin=htmlspecialchars(strip_tags($this->jenis_kelamin));
    
        // bind values
        $stmt->bindParam(":indeks", $this->indeks);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":bagian", $this->bagian);
        $stmt->bindParam(":jabatan", $this->jabatan);
        $stmt->bindParam(":kontrak", $this->kontrak);
        $stmt->bindParam(":jenis_kelamin", $this->jenis_kelamin);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readKaryawanPilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    indeks  = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->indeks);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
        // set values to object properties
        $this->indeks = $row['indeks'];
        $this->nama = $row['nama'];
        $this->bagian = $row['bagian'];
        $this->jabatan = $row['jabatan'];
        $this->kontrak = $row['kontrak'];
        $this->jenis_kelamin = $row['jenis_kelamin'];
    }


       // update the product
       function updateKaryawan(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    indeks = :indeks,
                    nama = :nama,
                    bagian = :bagian,
                    jabatan = :jabatan,
                    kontrak = :kontrak,
                    jenis_kelamin = :jenis_kelamin
                WHERE
                    indeks = :indeks";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->indeks=htmlspecialchars(strip_tags($this->indeks));
        $this->nama=htmlspecialchars(strip_tags($this->nama));
        $this->bagian=htmlspecialchars(strip_tags($this->bagian));
        $this->jabatan=htmlspecialchars(strip_tags($this->jabatan));
        $this->kontrak=htmlspecialchars(strip_tags($this->kontrak));
        $this->jenis_kelamin=htmlspecialchars(strip_tags($this->jenis_kelamin));

    
        // bind new values
        $stmt->bindParam(':indeks', $this->indeks);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':bagian', $this->bagian);
        $stmt->bindParam(':jabatan', $this->jabatan);
        $stmt->bindParam(':kontrak', $this->kontrak);
        $stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function deleteKaryawan(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE indeks = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->indeks=htmlspecialchars(strip_tags($this->indeks));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->indeks);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}
?>