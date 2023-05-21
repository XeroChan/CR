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

    <title>Wypożyczalnia aut</title>
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
            alert("Opinia dodana pomyślnie");
            <?php
            } else {
            ?>
            alert("Błąd w dodawaniu opinii");
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

        <article>
            <form method="GET" id="searchForm" action="#">
                <label for="searchBar"></label>
                <input id="searchBar" type="text" name="query" placeholder="Wyszukaj...">
                <button type="button" id="searchButton">Szukaj</button>
            </form>
        </article>

            <?php
            if(isset($_SESSION['username'])){
                $usern = $_SESSION['username'];
                echo 'Witaj '.$usern."! ";
                echo '<form method="GET" id="logoutForm" action="logout.php"'.'"><button type="submit" id="logoutButton">Wyloguj się</button></form>';
            } else{
                echo '<form method="POST" action="login.php">';
                echo '<button type="submit" id="loginButton">Zaloguj się</button>';
                echo '</form>';
            }
            ?>
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
                    <legend> Wystaw opinię:: </legend>
                    <label for="desc">Opinia:</label><br>
                    <textarea id="desc" name="review" rows="1" cols="50" placeholder="Oceń nas!"></textarea>
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