<?php
# Connexion a la base de Donnee Mysql
$host = "localhost";
$username="root";
$password="";
$dbname="bacapirest";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn){
    die("Erreur de connection: ".mysqli_connect_error());
}

?>
