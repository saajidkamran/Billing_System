<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../Config/Database.php';
    include_once '../Object/Product.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $product = new product($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $product->name=$data->name;
    
    $product->Value=$data->Value;
    
    if($product->add_ProductValue()){
        echo json_encode(" data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>