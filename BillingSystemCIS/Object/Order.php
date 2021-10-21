<?php 
/**
* This is the Order class and its functions.
*
* @package    pagelevel_package
* @category   Order
* @author     m.saajid
* @version    1.0
* ...
*/
class Orders{
 
    /** database connection and table name*/
    private $conn;
    private $table_name = "product";
    
    /**other table order to acess the  order insert */
    private $table_name2 = "orders";


    

    /** object properties*/
   
    public $name;
    public $price;
    public $Value;
    public $orderValue;
    public $totalamount;
    public $totalprice;
 

 
    /** constructor with $db as database connection*/
    public function __construct($db){
        $this->conn = $db;
    }
   /** function to add order  */

    function add_order()
    {
 
                    /** query to insert record*/
                    $query = "UPDATE
                                " . $this->table_name2 . "
                            SET
                                  name= :name, purchased = :orderValue, totalprice=( price * purchased)
                              WHERE
                                  name= :name 
                                   ";


                 
                    /** prepare query*/
                    $stmt = $this->conn->prepare($query);
                 
                    /** sanitize*/
                    $this->name=htmlspecialchars(strip_tags($this->name));
                    $this->orderValue=htmlspecialchars(strip_tags($this->orderValue));
                   
                 
                    /** bind values*/
                    $stmt->bindParam(":name", $this->name);
                    
                   $stmt->bindParam(":orderValue", $this->orderValue);
              
                if($stmt->execute())
                {
                 return true;
                }
                 return false;
    }

   /** function to add Stock product value  */
     function add_ProductValue(){
 
        /** query to insert record and find by name */
             $sqlQuery = "UPDATE
                        ". $this->table_name ."
                    SET
                        orderValue = (orderValue + :orderValue) ,Value = ( Value - :orderValue),totalamount=( price * :orderValue)
                     WHERE 
                       name= :name ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->Value=htmlspecialchars(strip_tags($this->Value));
             $this->orderValue=htmlspecialchars(strip_tags($this->orderValue));
        
            /** bind data*/
            $stmt->bindParam(":name", $this->name);
           $stmt->bindParam(":Val ue", $this->Value);
            $stmt->bindParam(":orderValue", $this->orderValue);
    /** execute query*/
    if($stmt->execute()){
               return true;
            }
            return false;
        }

    /**fuctionget total price*/
    function read_ordertotal(){
 
    /**select all query*/
    $query = "SELECT
                 `totalprice` 
            FROM
                 ". $this->table_name2 . "

            WHERE
                  name=? 
                 ";


 
    /**prepare query statement*/
     $stmt = $this->conn->prepare( $query );
 
    /**bind nameyyy of product to be updated*/
    $stmt->bindParam(1, $this->name);
 
    /**execute query*/
    $stmt->execute();
 
    /**get retrieved row*/
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    /**set values to object properties*/
    $this->totalprice = $row['totalprice'];
    
}


    

}
?>
