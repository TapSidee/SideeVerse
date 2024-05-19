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
            // Успешно добавлено
            header('Location: ../administration.php?conf=Успешно добавлено'); // Перенаправление обратно на страницу администрации
            exit();
        } else {
            // Ошибка при выполнении запроса
            header("Location: ../administration.php?error=Ошибка: " . $connection->error);
            exit();
        }
    } else {
        // Если запрос не является POST, перенаправление на страницу администрации
        header('Location: ../administration.php');
        exit();
    }
?>
