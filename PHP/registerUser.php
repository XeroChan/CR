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

        $query = "INSERT INTO tbl_users (Username, Password) VALUES (?, ?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $login, $password);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Registration successful. Please login.";
            header('Location: ../HTML/registration.php');
        } else {
            $_SESSION['message'] = "Registration failed.";
            header('Location: ../HTML/registration.php');
        }
    }

    $stmt->close();
    $connect->close();
}
