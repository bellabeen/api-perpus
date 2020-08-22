<?php
class DetilVote{
  
    // database connection and table name
    private $conn;
    private $table_name = "detil_vote";
  
    // object properties
    public $id_vote;
    public $id_request;
    public $indeks;
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function readDetilVote(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id_vote DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function createDetilVote(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_vote=:id_vote, id_request=:id_request, indeks=:indeks";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_vote=htmlspecialchars(strip_tags($this->id_vote));
        $this->id_request=htmlspecialchars(strip_tags($this->id_request));
        $this->indeks=htmlspecialchars(strip_tags($this->indeks));

        // bind values
        $stmt->bindParam(":id_vote", $this->id_vote);
        $stmt->bindParam(":id_request", $this->id_request);
        $stmt->bindParam(":indeks", $this->indeks);

    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }


    // used when filling up the update product form
    function readDetilVotePilihan(){
        // query to read single record
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_vote = ?
                ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_vote);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id_vote = $row['id_vote'];
        $this->id_request = $row['id_request'];
        $this->indeks = $row['indeks'];

    }


    // update the product
    function updateDetilVote(){    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    id_vote = :id_vote,
                    id_request = :id_request,
                    indeks = :indeks
                WHERE
                    id_vote = :id_vote";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_vote=htmlspecialchars(strip_tags($this->id_vote));
        $this->id_request=htmlspecialchars(strip_tags($this->id_request));
        $this->indeks=htmlspecialchars(strip_tags($this->indeks));

    
        // bind new values
        $stmt->bindParam(':id_vote', $this->id_vote);
        $stmt->bindParam(':id_request', $this->id_request);
        $stmt->bindParam(':indeks', $this->indeks);

    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }


    // delete the product
    function deleteDetilVote(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_vote = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_vote=htmlspecialchars(strip_tags($this->id_vote));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_vote);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
}

?>