<?php
class Anggota{
  
    // database connection and table name
    private $conn;
    private $table_name = "anggota";
  
    // object properties
    public $indeks;
    public $hp;
    public $email;
    public $tanggal_daftar;
    public $kata_sandi;
    public $foto;
    public $status;
    public $id_sesi;
    public $lastlogin;
    public $host;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readAnggota(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    indeks DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createAnggota(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    indeks=:indeks, hp=:hp, email=:email, tanggal_daftar=:tanggal_daftar, kata_sandi=:kata_sandi, foto=:foto, 
                    status=:status, id_sesi=:id_sesi, lastlogin=:lastlogin, host=:host";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->indeks=htmlspecialchars(strip_tags($this->indeks));
        $this->hp=htmlspecialchars(strip_tags($this->hp));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->tanggal_daftar=htmlspecialchars(strip_tags($this->tanggal_daftar));
        $this->kata_sandi=htmlspecialchars(strip_tags($this->kata_sandi));
        $this->foto=htmlspecialchars(strip_tags($this->foto));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->id_sesi=htmlspecialchars(strip_tags($this->id_sesi));
        $this->lastlogin=htmlspecialchars(strip_tags($this->lastlogin));
        $this->host=htmlspecialchars(strip_tags($this->host));
    
        // bind values
        $stmt->bindParam(":indeks", $this->indeks);
        $stmt->bindParam(":hp", $this->hp);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":tanggal_daftar", $this->tanggal_daftar);
        $stmt->bindParam(":kata_sandi", $this->kata_sandi);
        $stmt->bindParam(":foto", $this->foto);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id_sesi", $this->id_sesi);
        $stmt->bindParam(":lastlogin", $this->lastlogin);
        $stmt->bindParam(":host", $this->host);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readAnggotaPilihan(){
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
        $this->hp = $row['hp'];
        $this->email = $row['email'];
        $this->tanggal_daftar = $row['tanggal_daftar'];
        $this->kata_sandi = $row['kata_sandi'];
        $this->foto = $row['foto'];
        $this->status = $row['status'];
        $this->id_sesi = $row['id_sesi'];
        $this->lastlogin = $row['lastlogin'];
        $this->host = $row['host'];
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