<?php
session_start();
require_once "db_connect.php";
if (isset($host) && isset($user) && isset($pass) && isset($database)) {
    $connect = @new mysqli($host, $user, $pass, $database);
    if ($connect->connect_errno != 0) {
        echo "Error: " . $connect->connect_errno . " Description: " . $connect->connect_error;
    } else {
        $login = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM tbl_users WHERE Username='$login' AND Password='$password'";
        if ($result = @$connect->query($query)) {
            $users = $result->num_rows;
            if ($users > 0) {
                $row = $result->fetch_assoc();
                $user = $row['Username'];
                $passwd = $row['Password'];
                $_SESSION['username'] = $user;
                $result->free_result();
                header('Location: ../HTML/index.php');
            } else {
                $_SESSION['error'] = 'Nie znaleziono takiego użytkownika. <br> Spróbuj się zarejestrować.';
                header('Location: ../HTML/login.php');
            }
        }
        $connect->close();
    }
}
