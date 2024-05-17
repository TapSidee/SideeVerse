<?php
    // Подключение конфигурационного файла
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получение данных из формы
        $country_name = mysqli_real_escape_string($connection, $_POST['country_name']);

        // Выполнение SQL-запроса для вставки данных о стране
        $query = "INSERT INTO country (country_name) VALUES ('$country_name')";

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
