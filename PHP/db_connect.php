<?php
require_once "connect.php";

if (isset($host)&&isset($user)&&isset($pass)&&isset($database)) {
    $connect = @new mysqli($host, $user, $pass, $database);
    if($connect->connect_errno!=0){
        echo "Error: ".$connect->connect_errno."Description: ".$connect->connect_error;
    }
}

