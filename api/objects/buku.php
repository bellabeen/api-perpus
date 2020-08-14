<?php
class Buku{
  
    // database connection and table name
    private $conn;
    private $table_name = "buku";
  
    // object properties
    public $id_buku;
    public $judul;
    public $ddc;
    public $issn;
    public $no_panggil;
    public $penerbit;
    public $tahun;
    public $cetakan_ke;
    public $bahasa;
    public $jumlah_buku;
    public $klasifikasi;
    public $keterangan;
    public $cover;
    public $own;
    public $jumlah;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readBuku(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_buku DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createBuku(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_buku=:id_buku, judul=:judul, ddc=:ddc, issn=:issn, no_panggil=:no_panggil, penerbit=:penerbit, 
                    tahun=:tahun, cetakan_ke=:cetakan_ke, bahasa=:bahasa,
                    jumlah_buku=:jumlah_buku, klasifikasi=:klasifikasi, keterangan=:keterangan, cover=:cover,
                    own=:own, jumlah=:jumlah";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_buku=htmlspecialchars(strip_tags($this->id_buku));
        $this->judul=htmlspecialchars(strip_tags($this->judul));
        $this->ddc=htmlspecialchars(strip_tags($this->ddc));
        $this->issn=htmlspecialchars(strip_tags($this->issn));
        $this->no_panggil=htmlspecialchars(strip_tags($this->jam_pesan));
        $this->penerbit=htmlspecialchars(strip_tags($this->expired_date));
        $this->tahun=htmlspecialchars(strip_tags($this->tanggal_pinjam));
        $this->cetakan_ke=htmlspecialchars(strip_tags($this->batas_kembali));
        $this->bahasa=htmlspecialchars(strip_tags($this->tanggal_pengembalian));
        $this->jumlah_buku=htmlspecialchars(strip_tags($this->status));
        $this->klasifikasi=htmlspecialchars(strip_tags($this->PP));
        $this->keterangan=htmlspecialchars(strip_tags($this->PP));
        $this->cover=htmlspecialchars(strip_tags($this->PP));
        $this->own=htmlspecialchars(strip_tags($this->PP));
        $this->jumlah=htmlspecialchars(strip_tags($this->PP));
    
        // bind values
        $stmt->bindParam(":id_buku", $this->id_buku);
        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":ddc", $this->ddc);
        $stmt->bindParam(":issn", $this->issn);
        $stmt->bindParam(":no_panggil", $this->no_panggil);
        $stmt->bindParam(":penerbit", $this->penerbit);
        $stmt->bindParam(":tahun", $this->tahun);
        $stmt->bindParam(":cetakan_ke", $this->cetakan_ke);
        $stmt->bindParam(":bahasa", $this->bahasa);
        $stmt->bindParam(":jumlah_buku", $this->jumlah_buku);
        $stmt->bindParam(":klasifikasi", $this->klasifikasi);
        $stmt->bindParam(":keterangan", $this->keterangan);
        $stmt->bindParam(":cover", $this->cover);
        $stmt->bindParam(":own", $this->own);
        $stmt->bindParam(":jumlah", $this->jumlah);

    
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