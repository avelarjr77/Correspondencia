<?php

error_reporting('E_ERROR'); 

    $host="localhost";
    $user="root";
    $password="";
    $bd="correspondencia";

    $conn=mysqli_connect($host,$user,$password,$bd);

    if (!$conn) {
        $response=array('success'=>false, 'error'=>"No hay conexión a la base de datos");

        echo json_encode($response);
        exit();
    }else{
        $response=array();
        mysqli_set_charset($conn, 'utf8');
    }
?>