<?php
/**
* This is the User class and its functions.
*
* @package    pagelevel_package
* @category   User
* @author     m.saajid
* @version    1.0
* ...
*/

class User{
 
    /**database connection and table name*/
    private $conn;
    private $table_name = "user";
 
    /**object properties*/
    
    public $name;
    public $email;
    public $password;
    public $phnno;

   
 
    /**constructor with $db as database connection*/
    public function __construct($db){
        $this->conn = $db;
    }

    /**validate user by email*/
    function validEmail(){
        $query = "SELECT * 
                FROM 
                    ". $this->table_name ." 
                WHERE 
                    email = :email";

        /**preparing statement*/
        $stmt = $this->conn->prepare($query);

        /**binding student email*/
        $stmt->bindParam(':email', $this->email);

        /**execute and fetch row count*/
        $stmt->execute();
        $num = $stmt->rowCount();
        
        if($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            /**assigning validated user details*/
            
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->phnno = $row['phnno'];

            return true;
        }
        else{
            return false;
        }
    }

    /**create user*/
    function add_user(){
 
    /**query to insert record*/
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
               name=:name, email=:email, password=:password , phnno=:phnno";


 
    /**prepare query*/
    $stmt = $this->conn->prepare($query);
 
    /**sanitize*/

    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->phnno=htmlspecialchars(strip_tags($this->phnno));

 
    /**bind values*/

    $stmt->bindParam(":name", $this->name); 
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":phnno", $this->phnno);

    /**hash the password before saving to database*/
    $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password_hash);
 
    /**execute query*/
    if($stmt->execute()){
        return true;
    }
 
    return false;
     

}

    /**get unique user*/
  function get_unique_user(){
 
    /**query to read single record*/
    $query = "SELECT
                 `name`, `email`, `password`,'phnno'
            FROM
                 ". $this->table_name . "
            WHERE
                name = ?";
 
    /**prepare query statement*/
    $stmt = $this->conn->prepare( $query );
 
    /**bind id of user to be updated*/
    $stmt->bindParam(1, $this->name);
 
    /**execute query*/
    $stmt->execute();
 
    /**get retrieved row*/
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    /**set values to object properties*/
    $this->name = $row['name'];
    $this->email = $row['email'];
    $this->password = $row['password'];    
    $this->phnno = $row['phnno'];

   
}


  

    /**delete the user*/
    function delete_user(){
 
    /**delete query*/
    $query = "DELETE FROM " . $this->table_name . " WHERE name = ?";
 
    /**prepare query*/
    $stmt = $this->conn->prepare($query);
 
    /**sanitize*/
    $this->name=htmlspecialchars(strip_tags($this->name));
 
    /**bind name of record to delete*/
     $stmt->bindParam(1, $this->name);
 
    /** execute query*/
    if($stmt->execute()){
        return true;
    }
    else
    {
    echo "Error occured";
    return false;
    }
    


    }
}
?>
