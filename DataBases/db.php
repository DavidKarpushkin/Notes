<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Notes";

    $conn = mysqli_connect("$hostname","$username","$password","$dbname");
    session_start();
    if(!$conn){
        die("Ошибка соединения:".$conn -> connect_error);
    }


