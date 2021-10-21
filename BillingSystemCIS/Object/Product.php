<?
/**
* This is the Product class and its functions.
*
* @package    pagelevel_package
* @category   Product
* @author     m.saajid
* @version    1.0
* ...
*/

class product{
 
    /** database connection and table name*/
    private $conn;
    private $table_name ="product";
 
    /**object properties*/
    public $price;
    public $Value;
    public $name;
 
    /** constructor with $db as database connection */
    public function __construct($db){
        $this->conn = $db;
    }

    /** function that read product detail*/
    function readproduct(){
 
    /** select all query*/
    $query = "SELECT
                 `name`, `price`,`Value` 
            FROM
                 ". $this->table_name . "";


 
    /** prepare query statement*/
    $stmt = $this->conn->prepare($query);
 
    /**execute query*/
    $stmt->execute();
 
    return $stmt;
}

    /** update product stock value*/
    function add_ProductValue(){
 
   /**query to insert record and find by name */
             $sqlQuery = "UPDATE
                        ". $this->table_name ."
                    SET
                        Value = :Value 
                     WHERE 
                       name= :name";
            /**prepare query statement*/
            $stmt = $this->conn->prepare($sqlQuery);
            /**sanitize*/
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->Value=htmlspecialchars(strip_tags($this->Value));
        
            /** bind data*/
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":Value", $this->Value);
    /**execute query*/
    if($stmt->execute()){
               return true;
            }
            return false;
        }
     

 

    /** get product  detail*/
    function getProductDetail(){
 
    /**query to read single record*/
    $query = "SELECT
                `name`, `Value`
            FROM
                 ". $this->table_name . "
          ";
 
    $stmt = $this->conn->prepare($query);
 
    /**execute query*/
    $stmt->execute();
 
    return $stmt;

    
}

  
}


?>
