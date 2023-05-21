<?php
session_start();
require_once "db_connect.php";
if (isset($host) && isset($user) && isset($pass) && isset($database)) {
    $connect = @new mysqli($host, $user, $pass, $database);
    if ($connect->connect_errno != 0) {
        echo "Error: " . $connect->connect_errno . " Description: " . $connect->connect_error;
    } else {
        $car = $_SESSION['car'];
        unset($_SESSION['car']);
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];

        // Dodaj nowy rekord do tabeli reservations
        $query = "INSERT INTO tbl_reservations (Car_ID, StartDate, EndDate) VALUES ('$car', '$sdate', '$edate')";
        if ($connect->query($query) === TRUE) {
            $_SESSION['successRent'] = true;
            header('Location: ../HTML/rentForm.php');
        } else {
            echo "Błąd podczas dodawania rekordu: " . $connect->error;
        }


    }
    $connect->close();
}
?>
