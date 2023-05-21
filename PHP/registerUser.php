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

        $name = $_POST['name'];
        $sname = $_POST['sname'];
        $email = $_POST['email'];
        $tel = $_POST['phoneN'];

        $query = "INSERT INTO tbl_users (Username, Password, Name, Surname, Email, Phone) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssssss", $login, $password, $name, $sname, $email, $tel);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Registration successful. Please login.";
            $_SESSION['successR'] = true;
            header('Location: ../HTML/registration.php');
        } else {
            $_SESSION['message'] = "Registration failed.";
            $_SESSION['successR'] = false;
            header('Location: ../HTML/registration.php');
        }
    }

    $stmt->close();
    $connect->close();
}
