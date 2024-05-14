<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Выполнение SQL-запроса для вставки данных об авторе
    $query = "INSERT INTO authors (first_name, last_name) VALUES ('$first_name', '$last_name')";

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