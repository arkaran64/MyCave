<?php

session_start();

if(isset($_GET['login'])) {
    header('Location: profil.php');
    exit;

}

if (isset($_GET['logout'])){
    session_destroy();
     header ('Location:index.php');
 }

    $servername = 'localhost'; $dbname='mycave';$user='root'; $pass='';
    try{
    $db = new PDO("mysql:host=$servername;dbname=$dbname",$user,$pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $ex){
        echo "Error : " . $ex->getMessage();
    }
?>

