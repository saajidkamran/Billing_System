<?php
/**
* This is the getting total API.
*
* @category   Order
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
     * @param $total
    */
    $database = new Database();
    $db = $database->getConnection();
    
    $total=new Orders($db);
   /** input  name to select the item */
    $total->name = isset($_GET["name"]) ? $_GET["name"] : die();
   
   /**accessing the total functio*/
    $total->read_ordertotal();
    /** checking name null*/
    if ($total->name!=null){
        /**inserting total into user array*/
        $user_arr = array(
        "totalprice" => $total->totalprice
        );
        /**print total array*/
         echo json_encode($user_arr);
    } else{
        /**print error*/
        echo json_encode("Data could not be printed");
    }
?>