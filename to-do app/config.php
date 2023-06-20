<?php 
$server ='localhost';
$login ='root';
$pass ='';

try {
$connexion =new PDO("mysql:host=$server;port=3345;dbname=base1",$login,$pass);
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "connexion reussie";
}
catch (PDOException $e){
    echo "error: ".$e->getMessage();
}
?>