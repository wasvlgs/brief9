<?php


    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "brief7";

    $cnx = new mysqli($host,$username,$password,$dbname);

    if(!$cnx){
        die("Connection Faild");
    }


?>