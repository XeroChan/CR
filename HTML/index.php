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


</head>
<body>

    <?php include '../PHP/db_connect.php';?>
    <section class="navBar">
        <section id="logo" onclick="location.href='index.php'">Szybkie kobiety i piękne samochody</section>
        <nav>
            <a href="/html/">HTML</a>
            <a href="/css/">CSS</a>
            <a href="/js/">JavaScript</a>
            <a href="/python/">Python</a>
        </nav>
        <article>
            <form method="GET" id="searchForm" action="#">
                <label for="searchBar"></label><input id="searchBar" type="text" name="query" placeholder="Wyszukaj...">
                <button type="button" id="searchButton">Szukaj</button>
            </form>
        </article>
        <form method="POST" action="login.php">
            <?php
            if(isset($_SESSION['user'])){
                $user = $_SESSION['user'];
                echo 'Witaj '.$user."!";
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
            <form>
                <fieldset>
                    <legend> Submit review:: </legend>
                    <label for="fname">First name:</label><br>
                    <input type="text" id="fname" name="fname" value="John"><br>
                    <label for="lname">Last name:</label><br>
                    <input type="text" id="lname" name="lname" value="Doe"><br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" value="youremail@gmail.com"><br><br>
                    <textarea id="desc" name="textarea" rows="3" cols="50"> ...
                    </textarea><br><br>
                    <button type="button" id="reviewButton">Opublikuj</button>
                </fieldset>
            </form>
        </article>
        
    </section>
</body>
</html>