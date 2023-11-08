<?php

require '../Connexion/dbcon.php';

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('function.php');
$requestMethod = $_SERVER["REQUEST_METHOD"];
if($requestMethod == "GET"){
    if(isset($_GET['id'])){

        $customer = getCustomer($_GET);
        echo $customer;
    }else{
        $customerList = getCustomerList();
        echo $customerList;
    }
}
else
{
    $data= [
        'status' => 405,
        'message' => $requestMethod. ' La Methode pas Autoriser',
    ];
    header("HTTP/1.0.405 La Methode pas Autoriser");
    echo json_encode($data);
        
}

?>
