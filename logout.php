<?php
    // Начало сессии
    session_start();

    // Очистка сессионной переменной auth
    $_SESSION['auth'] = null;

    // Перенаправление на главную страницу
    header("Location: index.php");
?>
