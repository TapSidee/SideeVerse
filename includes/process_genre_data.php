<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $genre_name = $_POST['genre_name'];

    // Выполнение SQL-запроса для вставки данных о стране
    $query = "INSERT INTO genres (genre_name) VALUES ('$genre_name')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        // Успешно добавлено
        header('Location: ../administration.php'); // Перенаправление обратно на страницу администрации
        exit();
    } else {
        // Ошибка при выполнении запроса
        echo 'Ошибка: ' . mysqli_error($connection);
    }
} else {
    // Если запрос не является POST, перенаправьте на страницу администрации
    header('Location: ../administration.php');
    exit();
}
?>