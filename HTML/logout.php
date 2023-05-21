<?php
session_start();
session_unset(); // Usuwa wszystkie zmienne sesji
session_destroy(); // Niszczy sesję

// Przekierowanie do strony logowania lub innej strony docelowej
header("Location: index.php");
exit();