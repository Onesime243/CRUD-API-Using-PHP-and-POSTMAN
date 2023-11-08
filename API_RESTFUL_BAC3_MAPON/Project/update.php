<?php
error_reporting(0);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include('function.php');
$requestMethod = $_SERVER["REQUEST_METHOD"];
if($requestMethod ==  'PUT'){
    $inputData = json_decode(file_get_contents("php://input"), true);
    if(empty($inputData)){
        $updateCustomer = updateCustomer($_POST, $_GET);
    }else{
        $updateCustomer = updateCustomer($inputData, $_GET);
    }
    echo $updateCustomer;
}
else
{
    $data= [
        'status' => 405,
        'message' => $requestMethod. '  Methode non autorisee',
    ];
    header("HTTP/1.0.405 Echec");
    echo json_encode($data);

}

?>