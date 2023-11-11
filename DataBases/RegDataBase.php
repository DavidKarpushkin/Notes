<?php

    $hostname = "localhost";
    $Username = "root";
    $Pass = "";
    $db = "Registration";

    $conn2 = mysqli_connect("$hostname","$Username","$Pass","$db");
    session_start();
    if(!$conn2){
        die("Ошибка соединения:". $conn2 -> connect_error);
    }