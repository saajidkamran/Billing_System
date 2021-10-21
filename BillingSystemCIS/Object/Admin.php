<?php
/**
* This is the Admin class and its functions.
*
* @package    pagelevel_package
* @category   Admin
* @author     m.saajid
* @version    1.0
* ...
*/
class Admin{
 
    /**database connection and table name*/
    private $conn;
    private $table_name = "admin";
 
    /** object properties*/
    public $email;
    public $password;

 
    /**
    *   constructor with $db as database connection
    *   @param $db
    */
    public function __construct($db){
        $this->conn = $db;
    }

    /** read Admin */
    function read_admin(){
 
    /** select all query*/
    $query = "SELECT
                `email`, `password`
            FROM
                 ". $this->table_name . "";


 
    /**
    *   prepare query statement
    *   @param $stmt
    */ 
    $stmt = $this->conn->prepare($query);
 
    /** execute query*/
    $stmt->execute();
 
    return $stmt;
}
}