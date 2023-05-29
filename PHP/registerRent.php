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

        // Pobierz wybrane daty z formularza
        $sdate = $_POST['sdate'];
        $edate = $_POST['edate'];

        // Konwertuj daty na obiekty typu DateTime
        try {
            $startDateTime = new DateTime($sdate);
        } catch (Exception $e) {
            echo $e;
        }
        try {
            $endDateTime = new DateTime($edate);
        } catch (Exception $ex) {
            echo $ex;
        }
        $currentDateTime = new DateTime();

        // Sprawdź, czy wybrana data rozpoczęcia jest późniejsza niż dzisiejsza data
        if ($startDateTime < $currentDateTime || $endDateTime < $currentDateTime) {
            $message = "Nie można wypożyczyć auta na przeszłą datę.";
            $_SESSION['message'] = $message;
            header('Location: ../HTML/rentForm.php');
        } else {

            $user = $_SESSION['username'];
            $userID='';
            $getUserID = "SELECT User_ID FROM tbl_users WHERE Username ='$user'";
            $result = $connect->query($getUserID);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userID = $row['User_ID'];
            }

            $query = "INSERT INTO tbl_reservations (Car_ID, StartDate, EndDate) VALUES ('$car', '$sdate', '$edate')";
            if ($connect->query($query) === TRUE) {
                $_SESSION['successRent'] = true;
                $getID = mysqli_insert_id($connect);
                $query2 = "INSERT INTO tbl_user_reservation_car (User_ID, Reservation_ID, Car_ID) VALUES ('$userID', '$getID', '$car')";
                if ($connect->query($query2) === TRUE) {
                    header('Location: ../HTML/rentForm.php');
                }
            } else {
                echo "Błąd podczas dodawania rekordu: " . $connect->error;
            }
        }
    }
    $connect->close();
}
