<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="../CSS/main.css">
</head>
<body>
<section class="navBar">
    <section id="logo" onclick="location.href='index.php'">Euroautka</section>
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

<div class="registration-container">
    <h1>Wypożycz pojazd</h1>
    <?php if (!empty($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <form method="POST" action="../PHP/registerRent.php">
        <label for="sdate">Data rozpoczęcia:</label>
        <input type="datetime-local" id="sdate" name="sdate" required>

        <label for="edate">Data zakończenia:</label>
        <input type="datetime-local" id="edate" name="edate" required>

        <div class="button-container">
            <button type="submit">Wypożycz</button>
        </div>
    </form>
</div>

</body>
</html>
