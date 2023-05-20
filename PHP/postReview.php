<?php
session_start();

require_once "db_connect.php";
if (isset($host) && isset($user) && isset($pass) && isset($database) && isset($_SESSION['username'])) {
    $connect = @new mysqli($host, $user, $pass, $database);
    if ($connect->connect_errno != 0) {
        echo "Error: " . $connect->connect_errno . " Description: " . $connect->connect_error;
    } else {
        $userRev = $_SESSION['username'];
        $review = $_POST['review']; // Pobierz zawartość recenzji z formularza

        // Pobierz ID użytkownika na podstawie nazwy użytkownika
        $queryUser = "SELECT User_ID FROM tbl_users WHERE Username = ?";
        $stmtUser = $connect->prepare($queryUser);
        $stmtUser->bind_param("s", $userRev);
        $stmtUser->execute();
        $stmtUser->store_result();

        if ($stmtUser->num_rows == 0) {
            echo "Error: User does not exist.";
            exit;
        }

        $stmtUser->bind_result($userID);
        $stmtUser->fetch();
        $stmtUser->close();

        // Wstawienie recenzji do tabeli tbl_review
        $query = "INSERT INTO tbl_review (Review) VALUES (?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $review);
        $stmt->execute();

        $reviewID = $stmt->insert_id; // Pobranie ID nowo wstawionego rekordu

        // Wstawienie rekordu do tabeli łączącej tbl_users_reviews
        $query2 = "INSERT INTO tbl_users_reviews (User_ID, Review_ID) VALUES (?, ?)";
        $stmt2 = $connect->prepare($query2);
        $stmt2->bind_param("ii", $userID, $reviewID);
        $stmt2->execute();

        if ($stmt->affected_rows > 0 && $stmt2->affected_rows > 0) {
            $_SESSION['post'] = "Review posting successful.";
            $_SESSION['success'] = true;
            header('Location: ../HTML/index.php');
        } else {
            $_SESSION['post'] = "Failed posting a review.";
            $_SESSION['success'] = false;
            header('Location: ../HTML/index.php');
        }
    }

    $stmt->close();
    $connect->close();
}
