<?php
/**
* This is the get product detail to external API.
*
* @category   Product
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

    include_once '../Object/Product.php';
     /**
 * creating database object
 * @param $database
 * @param $db
 * @param $info
 */
    $database = new Database();
    $db = $database->getConnection();
    
  
    $info=new Product($db);
   
 
/** query user access fuction */
$stmt = $info->getProductDetail();
$num = $stmt->rowCount();

 
/** check if more than 0 record found*/
if($num>0){
 
    /** 
    *user array
    * @param $product_arr
    */
    $product_arr=array();
    $product_arr["records"]=array();
 
    /** retrieve our table contents*/
    $i=1;
     

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        /** extract row*/
        extract($row);
        

        $product_detail=array(
            "name " => $name,
            "Value".$i => $Value
        );
       $i++;
         /**inserting product detail  into array */

        array_push($product_arr["records"], $product_detail);
    }
 
/** set response code - 200 OK*/
    http_response_code(200);
 
    /**show user data in json format*/
    echo json_encode($product_arr);
}
 
else{
    /** error respose code */
       http_response_code(404);
         echo json_encode( array("message" => "No products found."));


    }

?>