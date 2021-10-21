<?php
/**
* This is the delete User API.
*
* @category   Admin
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
 
/**include database connection*/
include_once '../Config/Database.php';
/** instantiate product object*/

include_once '../Object/User.php';
 
 /**
 * creating database object
 * @param $database
 * @param $db
 */
$database = new Database();
$db = $database->getConnection();
 
/**
  * creating user object
  * @param $user
  */ 
$user = new User($db);
 
/**
 * get posted data
 * @param $data
 */
$data = json_decode(file_get_contents("php://input"));
 
/** set user name to be deleted*/
$user->name = $data->name;
 
/** delete the user*/
if($user->delete_user()){
 
    /** set response code - 200 ok */
    http_response_code(200);
 
    /** tell the user*/
    echo json_encode(array("message" => "User was deleted."));
}
 
/** if unable to delete the user*/
else{
 
    /** set response code - 503 service unavailable*/
    http_response_code(503);
 
    /** tell the user*/
    echo json_encode(array("message" => "Unable to delete user."));
}
?>