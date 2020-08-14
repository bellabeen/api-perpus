<?php
class Peminjaman{
  
    // database connection and table name
    private $conn;
    private $table_name = "peminjaman";
  
    // object properties
    public $id_peminjaman;
    public $id_buku;
    public $id_peminjam;
    public $tanggal_pesan;
    public $jam_pesan;
    public $expired_date;
    public $tanggal_pinjam;
    public $batas_kembali;
    public $tanggal_pengembalian;
    public $status;
    public $PP;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readPeminjaman(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_peminjaman DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createPeminjaman(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_buku=:id_buku, id_peminjam=:id_peminjam, tanggal_pesan=:tanggal_pesan, jam_pesan=:jam_pesan, expired_date=:expired_date, 
                    tanggal_pinjam=:tanggal_pinjam, batas_kembali=:batas_kembali, tanggal_pengembalian=:tanggal_pengembalian,
                    status=:status, PP=:PP";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_buku=htmlspecialchars(strip_tags($this->id_buku));
        $this->id_peminjam=htmlspecialchars(strip_tags($this->id_peminjam));
        $this->tanggal_pesan=htmlspecialchars(strip_tags($this->tanggal_pesan));
        $this->jam_pesan=htmlspecialchars(strip_tags($this->jam_pesan));
        $this->expired_date=htmlspecialchars(strip_tags($this->expired_date));
        $this->tanggal_pinjam=htmlspecialchars(strip_tags($this->tanggal_pinjam));
        $this->batas_kembali=htmlspecialchars(strip_tags($this->batas_kembali));
        $this->tanggal_pengembalian=htmlspecialchars(strip_tags($this->tanggal_pengembalian));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->PP=htmlspecialchars(strip_tags($this->PP));
    
        // bind values
        $stmt->bindParam(":id_buku", $this->id_buku);
        $stmt->bindParam(":id_peminjam", $this->id_peminjam);
        $stmt->bindParam(":tanggal_pesan", $this->tanggal_pesan);
        $stmt->bindParam(":jam_pesan", $this->jam_pesan);
        $stmt->bindParam(":expired_date", $this->expired_date);
        $stmt->bindParam(":tanggal_pinjam", $this->tanggal_pinjam);
        $stmt->bindParam(":batas_kembali", $this->batas_kembali);
        $stmt->bindParam(":tanggal_pengembalian", $this->tanggal_pengembalian);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":PP", $this->PP);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readPeminjamanPilihan(){
            //     // select all query
            //     $query = "SELECT
            //     *
            // FROM
            //     " . $this->table_name . " 
            // ORDER BY
            //     id_peminjaman DESC";

        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_peminjaman = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_peminjaman);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_buku = $row['id_buku'];
        $this->id_peminjam = $row['id_peminjam'];
        $this->tanggal_pesan = $row['tanggal_pesan'];
        $this->jam_pesan = $row['jam_pesan'];
        $this->expired_date = $row['expired_date'];
        $this->tanggal_pinjam = $row['tanggal_pinjam'];
        $this->batas_kembali = $row['batas_kembali'];
        $this->tanggal_pengembalian = $row['tanggal_pengembalian'];
        $this->status = $row['status'];
        $this->PP = $row['PP'];
    }


    // update the product
    function updatePeminjaman(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_buku = :id_buku,
                    id_peminjam = :id_peminjam,
                    tanggal_pesan = :tanggal_pesan,
                    jam_pesan = :jam_pesan,
                    expired_date = :expired_date,
                    tanggal_pinjam = :tanggal_pinjam,
                    batas_kembali = :batas_kembali,
                    tanggal_pengembalian = :tanggal_pengembalian,
                    status = :status,
                    PP = :PP
                WHERE
                    id_peminjaman = :id_peminjaman";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_buku=htmlspecialchars(strip_tags($this->id_buku));
        $this->id_peminjam=htmlspecialchars(strip_tags($this->id_peminjam));
        $this->tanggal_pesan=htmlspecialchars(strip_tags($this->tanggal_pesan));
        $this->jam_pesan=htmlspecialchars(strip_tags($this->jam_pesan));
        $this->expired_date=htmlspecialchars(strip_tags($this->expired_date));
        $this->tanggal_pinjam=htmlspecialchars(strip_tags($this->tanggal_pinjam));
        $this->batas_kembali=htmlspecialchars(strip_tags($this->batas_kembali));
        $this->tanggal_pengembalian=htmlspecialchars(strip_tags($this->tanggal_pengembalian));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->PP=htmlspecialchars(strip_tags($this->PP));
        $this->id_peminjaman=htmlspecialchars(strip_tags($this->id_peminjaman));
    
        // bind new values
        $stmt->bindParam(':id_buku', $this->id_buku);
        $stmt->bindParam(':id_peminjam', $this->id_peminjam);
        $stmt->bindParam(':tanggal_pesan', $this->tanggal_pesan);
        $stmt->bindParam(':jam_pesan', $this->jam_pesan);
        $stmt->bindParam(':expired_date', $this->expired_date);
        $stmt->bindParam(':tanggal_pinjam', $this->tanggal_pinjam);
        $stmt->bindParam(':batas_kembali', $this->batas_kembali);
        $stmt->bindParam(':tanggal_pengembalian', $this->tanggal_pengembalian);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':PP', $this->PP);
        $stmt->bindParam(':id_peminjaman', $this->id_peminjaman);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deletePeminjaman(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_peminjaman = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_peminjaman=htmlspecialchars(strip_tags($this->id_peminjaman));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_peminjaman);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}


?>