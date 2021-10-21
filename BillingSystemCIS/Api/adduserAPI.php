<?php
/**
* This is the add User API.
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
 
/** get database connection*/

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
$User = new user($db);
 
/**
 * get posted data
 * @param $data
 */
$data = json_decode(file_get_contents("php://input"));
 
/** make sure data is not empty*/
if(
    !empty($data->name) &&
    !empty($data->email) &&
    !empty($data->password) &&
    !empty($data->phnno)
){
 
    /** set user property values*/
    $User->name = $data->name;
    $User->email = $data->email;
    $User->password = $data->password;
    $User->phnno = $data->phnno;

    
 
    /** create the user*/
    if($User->add_user()){
 
        /** set response code - 201 created*/
        http_response_code(201);
 
        /** tell the user*/
        echo json_encode(array("message" => "Register successfull."));
    }
 
    /** if unable to create the user, tell the user*/
    else{
 
        /** set response code - 503 service unavailable*/
        http_response_code(503);
 
        /** tell the user*/
        echo json_encode(array("message" => "Registration unsuccessful."));
    }
}
 
/** tell the user data is incomplete*/
else{
 
    /** set response code - 400 bad request*/
    http_response_code(400);
 
    /** tell the user*/
    echo json_encode(array("message" => "Unable to Register. Data is incomplete."));
}
?>  