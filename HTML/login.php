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

</section>

<div class="login-container">
    <h1>Zaloguj się</h1>
    <?php if (!empty($message)) { ?>
        <p class="error"><?php echo $message; ?></p>
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
