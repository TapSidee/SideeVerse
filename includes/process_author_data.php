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
