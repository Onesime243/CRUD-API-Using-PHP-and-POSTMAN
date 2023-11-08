<?php
error_reporting(0);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include('function.php');
$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "DELETE"){

    $deletecustomer = deleteCustomer($_GET);
    echo $deletecustomer;
}else{
    $data= [
        'status' => 405,
        'message' => $requestMethod. '  Methode non autorisee',
    ];
    header("HTTP/1.0.405 Echec");
    echo json_encode($data);
}