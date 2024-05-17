<?php
    // Подключение конфигурационного файла
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получение данных из формы
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);

        // Выполнение SQL-запроса для вставки данных об авторе
        $query = "INSERT INTO authors (first_name, last_name) VALUES ('$first_name', '$last_name')";

        $result = mysqli_query($connection, $query);

        if ($result) {
            // Успешно добавлено, перенаправление обратно на страницу администрации
            header('Location: ../administration.php');
            exit();
        } else {
            // Ошибка при выполнении запроса
            echo 'Ошибка: ' . mysqli_error($connection);
        }
    } else {
        // Если запрос не является POST, перенаправление на страницу администрации
        header('Location: ../administration.php');
        exit();
    }
?>
