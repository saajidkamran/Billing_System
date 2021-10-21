<?php
/**
* This is the log in  API.
*
* @category   User
* @author    m.saajid
* @version    1.0
* ...
*/
/** required headers*/
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
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
*instantiate user object
* @param $user
*/
$user = new User($db);
 
/** 
*get posted data
*@param $data
*/
$data = json_decode(file_get_contents("php://input"));
 
/** set user property values*/
$user->email = $data->email;
/**accessing the functiop*/
$email_exists = $user->validEmail();
 
/** generate json web token*/
include_once '../Config/Core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
/** check if email exists and if password is correct*/
if($email_exists && password_verify($data->password, $user->password)){
 
    $token = array(
       "iat" => $issued_at,
       "exp" => $expiration_time,
       "data" => array(
           "name" => $user->name,
           "phnno" => $user->phnno,
           "email" => $user->email
       )
    );
 
    /** set response code*/
    http_response_code(200);
 
/** generate jwt*/
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );
 
}
 
/** login failed*/
else{
 
    /** set response code*/
    http_response_code(401);
 
    /** tell the user login failed*/
    echo json_encode(array("message" => "Login failed."));
}
?>