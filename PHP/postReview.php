<?php
// Include db_connect.php to access the $pdo object
require_once('db_connect.php');
// query the database using the search term

// Query the database using the search term
$query = $_POST['query'];
$sql = "INSERT INTO tbl_reviews (review) VALUES (?);";
if (isset($pdo)) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$query%"]);
}