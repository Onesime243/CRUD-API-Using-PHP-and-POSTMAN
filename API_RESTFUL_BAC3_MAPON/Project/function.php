<?php
require '../Connexion/dbcon.php';

function getCustomerList(){

    global $conn;

    $query = 'SELECT * FROM customers';
    $query_run = mysqli_query($conn, $query);
    if($query_run){

        if(mysqli_num_rows($query_run) > 0){

            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'la liste des clients ont ete renvoyes',
                'data' =>$res
            ];
            header("HTTP/1.0. 200 Success");
            return json_encode($data);
        }else{
            $data = [
                'status' => 504,
                'message' => 'Pas de donnees dans la base de donnees',
            ];
            header("HTTP/1.0. 504 Pas de donnees dans la base de donnees");
            return json_encode($data);
        }
    }else{
        $data = [
            'status' => 500,
            'message' => 'Erreur de Connecxion',
        ];
        header("HTTP/1.0. 500 Erreur de Connecxion");
        return json_encode($data);
    }
}

function error243($message){
    $data= [
        'status' => 420,
        'message' => $message,
    ];
    header("HTTP/1.0.422 format de données incorrect");
    echo json_encode($data);
    exit();
}
function storeCustomer($customerInput){
    global $conn;
    $name = mysqli_real_escape_string($conn, $customerInput['name']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);

    if(empty(trim($name))){
        return error243("Veuillez Enter Nom svp");

    }elseif(empty(trim($email))){
        return error243("Veuillez Enter Email svp");

    }elseif((empty(trim($phone)))){
        return error243("Veuillez Enter Phone svp");

    }
    else{
        $query ="INSERT INTO customers (name,email,phone) VALUES('$name','$email','$phone')";
        $result = mysqli_query($conn, $query);

        if(result){
            $data= [
                'status' => 201,
                'message' => 'customer created successfully',
            ];
            header("HTTP/1.0 201  created");
            return json_encode($data);

        }else{

            $data= [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 504  Internal Server Error");
            return json_encode($data);

        }
    }
}

function getCustomer($customeParams){
    global $conn;
    if($customeParams['id'] == null){
        return error243("Veuillez entrer le numero du client svp");

    } 
    $customerId= mysqli_real_escape_string($conn, $customeParams['id']);
    $query = "SELECT * FROM customers WHERE id='$customerId' LIMIT 1";
    $result = mysqli_query($conn, $query );
    if($result){
        if(mysqli_num_rows($result) == 1){
            $res = mysqli_fetch_assoc($result);
            $data= [
                'status' => 200,
                'message' => 'Client renvoyer avec succes',
                'data'=>$res 
            ];
            header("HTTP/1.0 201  success");
            return json_encode($data);
        }else{
            $data= [
                'status' => 404,
                'message' => 'Le client existe pas',
            ];
            header("HTTP/1.0 404  Not Found");
            return json_encode($data);
        }

    }
    else{
        $data= [
            'status' => 500,
            'message' => 'Erreur de connexion',
        ];
        header("HTTP/1.0 201  Erreur");
        return json_encode($data);

    }
}
function updateCustomer($customerInput, $CustomerParams){
    global $conn;
    if(!isset($CustomerParams['id'])){
        return error243("Le client n existe pas");
    }elseif ($CustomerParams['id']== null) {
        return error243("Veuillez introduire id svp");
    }
    $CustomerId = mysqli_real_escape_string($conn, $CustomerParams['id']);
    $name = mysqli_real_escape_string($conn, $customerInput['name']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);
    if(empty(trim($name))){
        return error422("Veuillez introduire le nom svp");
    }elseif(empty(trim($email))){
        return error422("Veuillez introduire le mail");
    }elseif((empty(trim($phone)))){
        return error422("Veuillez introduire le numero de telephone");
    }
    else{
        $query ="UPDATE customers SET name='$name',email='$email',phone='$phone' WHERE id='$CustomerId' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if(result){
            $data= [
                'status' => 200,
                'message' => 'Mise a jour effectuee',
            ];
            header("HTTP/1.0 200  Success");
            return json_encode($data);
        }else{
            $data= [
                'status' => 500,
                'message' => 'Erreur de connexion',
            ];
            header("HTTP/1.0 504  Echec");
            return json_encode($data);
        }
    }
}


function deleteCustomer( $CustomerParams){
    global $conn;
    if(!isset($CustomerParams['id'])){
        return error243("Le client n existe pas");

    }elseif ($CustomerParams['id']== null) {
        return error243("Veuillez introduire id svp");
    }
    $CustomerId = mysqli_real_escape_string($conn, $CustomerParams['id']);
    $query ="DELETE FROM customers WHERE id='$CustomerId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(result){
        $data= [
            'status' => 204,
            'message' => ' client supprimer',
        ];
        header("HTTP/1.0 200  Success");
        return json_encode($data);
    }else{
        $data= [
            'status' => 500,
            'message' => 'Erreur de connexion',
        ];
        header("HTTP/1.0 504  Echec");
        return json_encode($data);
    }
}

?>