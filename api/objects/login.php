<?php
class Login{
  
    // database connection and table name
    private $conn;
    private $table_name = "anggota";
    private $table_name1 = "user";
  
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
    public $id_user;
    public $username;
    public $password;
    public $nama;
    
  
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

    //login admin
    function loginAdmin(){
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name1 . " 
                WHERE
                    username='".$this->username."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    
}
?>