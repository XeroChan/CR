<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="../CSS/main.css">
</head>
<body>
<section class="navBar">
    <section id="logo" onclick="location.href='index.php'">Szybkie kobiety i piękne samochody</section>
    <nav>
        <a href="/html/">HTML</a>
        <a href="/css/">CSS</a>
        <a href="/js/">JavaScript</a>
        <a href="/python/">Python</a>
    </nav>
</section>

<div class="login-container">
    <h1>Zaloguj się</h1>
    <?php if (!empty($error)) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="../PHP/checkUser.php">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>

        <div class="button-container">
            <button type="submit">Zaloguj się</button>
            <button type="button" onclick="location.href='registration.php'">Zarejestruj się</button>
        </div>
    </form>
</div>

</body>
</html>
