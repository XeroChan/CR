<?php
require_once "db_connect.php";
if (isset($host) && isset($user) && isset($pass) && isset($database)) {
    $connect = @new mysqli($host, $user, $pass, $database);
    if ($connect->connect_errno != 0) {
        echo "Error: " . $connect->connect_errno . " Description: " . $connect->connect_error;
    } else {
// Pobierz opinie użytkowników
        $queryReviews = "SELECT tbl_users.Username, tbl_review.Review FROM tbl_users_reviews
                            INNER JOIN tbl_users ON tbl_users_reviews.User_ID = tbl_users.User_ID
                            INNER JOIN tbl_review ON tbl_users_reviews.Review_ID = tbl_review.Review_ID";
        $resultReviews = $connect->query($queryReviews);

        if ($resultReviews->num_rows > 0) {
            echo "<h2>Opinie użytkowników:</h2>";
            echo "<ul>";
            while ($row = $resultReviews->fetch_assoc()) {
                $username = $row['Username'];
                $review = $row['Review'];
                echo "<li><strong>$username:</strong> $review</li>";
            }
            echo "</ul>";
        }
    }
    $resultReviews->close();
    $connect->close();
}
