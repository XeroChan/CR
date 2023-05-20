<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="../CSS/main.css">
    <script>
        window.onload = function() {
            <?php
            if (isset($_SESSION['successR'])) {
            $successR = $_SESSION['successR'];
            unset($_SESSION['successR']);
            if ($successR) {
            ?>
            alert("User registered successfully.");
            <?php
            } else {
            ?>
            alert("Failed registering an user.");
            <?php
            }
            }
            ?>
        }
    </script>
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
    <form method="POST" action="login.php">
        <button type="submit">Zaloguj się</button>
    </form>
</section>

<div class="registration-container">
    <h1>Zarejestruj się</h1>
    <?php if (!empty($message)) { ?>
    <p><?php echo $message; ?></p>
    <?php } ?>
    <form method="POST" action="../PHP/registerUser.php">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Adres e-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm-password">Potwierdź hasło:</label>
        <input type="password" id="confirm-password" name="confirm-password" required>

        <div class="button-container">
            <button type="submit">Zarejestruj się</button>
        </div>
    </form>
</div>

</body>
</html>
