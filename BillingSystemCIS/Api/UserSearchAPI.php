<?php
 /**
* This is the  search unique user    API.
*
* @category  User
* @author    m.saajid
* @version    1.0
* ...
*/
/** required headers*/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
         /**include database connectin*/
include_once '../Config/Database.php';
         /** instantiate product object*/

include_once '../Object/User.php';
 
  /** 
  *creating database object
  * @param $database
  * @param $db
  */
$database = new Database();
$db = $database->getConnection();
 
/**
*prepare user object
* @param $user
*/
$user = new User($db);
 
 /**set ID property of record to read*/
$user->name = isset($_GET["name"]) ? $_GET["name"] : die();
 /** read the details of product to be edited accessing the fuction*/
$user->get_unique_user();
 /**check  name empty*/
if($user->name!=null){
    /**create array and inserting the data*/
    $user_arr = array(
        
        "name" => $user->name,
        "email" => $user->email,
        "password" => $user->password,
        "phnno" => $user->phnno

 
    );
 
    // set response code - 200 OK*/
    http_response_code(200);
 
    /** make it json format*/
    echo json_encode($user_arr);
}
 
else{
    /** set response code - 404 Not found*/
    http_response_code(404);
 
    /** tell the user user does not exist*/
    echo json_encode(array("message" => "user does not exist."));
}
?>