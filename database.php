<?php


    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "brief9";

    $cnx = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);

    if(!$cnx){
        die("Connection Faild");
    }





?>