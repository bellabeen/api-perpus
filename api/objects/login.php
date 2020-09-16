<?php
class Login{
  
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

    //login user
    function login(){
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                WHERE
                    indeks='".$this->indeks."' AND kata_sandi='".$this->kata_sandi."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    
}
?>