<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free Web tutorials">
    <meta name="author" content="John Doe">
    <!-- <meta http-equiv="refresh" content="30"> -->

    <title>Car Sharing</title>
    <link rel="stylesheet" href="../CSS/main.css">
    <script src="../JS/jquery-3.6.4.js"></script>
    <script src="../JS/main.js"></script>

    <script>
        window.onload = function() {
            <?php
            if (isset($_SESSION['success']) && isset($_SESSION['username'])) {
            $success = $_SESSION['success'];
            unset($_SESSION['success']);
            if ($success) {
            ?>
            alert("Review posted successfully.");
            <?php
            } else {
            ?>
            alert("Failed posting a review.");
            <?php
            }
            }
            ?>
        }
    </script>
</head>
<body>

    <?php include '../PHP/db_connect.php';?>
    <section class="navBar">
        <section id="logo" onclick="location.href='index.php'">Euroautka</section>
        <nav>
            <a href="/html/">HTML</a>
            <a href="/css/">CSS</a>
            <a href="/js/">JavaScript</a>
            <a href="/python/">Python</a>
        </nav>
        <article>
            <form method="GET" id="searchForm" action="#">
                <label for="searchBar"></label>
                <input id="searchBar" type="text" name="query" placeholder="Wyszukaj...">
                <button type="button" id="searchButton">Szukaj</button>
            </form>
        </article>
        <form method="POST" action="login.php">
            <?php
            if(isset($_SESSION['username'])){
                $usern = $_SESSION['username'];
                echo 'Witaj '.$usern."!";
            } else{
                echo '<button type="submit" id="loginButton">Zaloguj się</button>';
            }
            ?>
            
        </form>
    </section>
    <section class="main">
        <article id="database">
            <?php
            if (isset($_GET['query'])) {
                include '../PHP/search.php';
            } else {
                include '../PHP/getCars.php';
            }
            ?>
        </article>
        <article id="recommendations">
            <?php require "../PHP/getReviews.php" ?>
            <form method="POST" action="../PHP/postReview.php">
                <fieldset>
                    <legend> Submit review:: </legend>
                    <label for="desc">Review:</label><br>
                    <textarea id="desc" name="review" rows="1" cols="50" placeholder="Rate us"></textarea>
                    <?php
                    if(isset($_SESSION['username'])){
                        $user = $_SESSION['username'];
                        echo '<button type="submit" id="reviewButton">Opublikuj</button>';
                    } else{
                        echo '<p>Opinie mogą wystawić tylko zalogowani użytkownicy!</p>';
                    }
                    ?>

                </fieldset>
            </form>
        </article>
        
    </section>
</body>
</html>