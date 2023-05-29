<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="../CSS/main.css">
    <title>Rejestracja</title>
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
        <h1>Zarejestruj się</h1>
        <?php if (!empty($message)) { ?>
            <p><?php echo $message; ?></p>
        <?php } ?>
        <form method="POST" action="../PHP/registerUser.php">
            <label for="name">Imie:</label>
            <input type="text" id="name" name="name" required>

            <label for="sname">Nazwisko:</label>
            <input type="text" id="sname" name="sname" required>

            <label for="username">Nazwa użytkownika:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Adres e-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="phoneN">Nr Tel:</label>
            <input type="tel" id="phoneN" name="phoneN" required>

            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required>

            <div class="button-container">
                <button type="submit">Zarejestruj się</button>
            </div>
        </form>
    </div>
</body>
</html>
