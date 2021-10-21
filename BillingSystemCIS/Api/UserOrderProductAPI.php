<?php
 /**
* This is the Product value  API.
*
* @category  Product
* @author    m.saajid
* @version    1.0
* ...
*/
/** required headers*/
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
         /**include database connectin*/
    include_once '../Config/Database.php';
         /** instantiate product object*/
    include_once '../Object/Order.php';
    /** 
    *creating database object
     * @param $database
     * @param $db
     * @param $products
     * @param $orders

    */
    $database = new Database();
    $db = $database->getConnection();
    
    $products=new Orders($db);
    $orders = new Orders($db);
    /** 
    *get posted data
    *@param $data
    */

    $data=json_decode(file_get_contents("php://input"));
     /** set order property values*/  
    $orders->name=$data->name;
    $orders->orderValue=$data->orderValue;

     /** set product property values*/
    $products->name=$data->name;
    $products->orderValue=$data->orderValue;
  
     /** accessing the order and the product function */
    if ($products->add_order()&&$orders->add_ProductValue()){
        /** print success*/
         echo json_encode("success");
    } else{
         /**print error*/
        echo json_encode("Data could not be updated");
    }


?>