<?php
    // Подключение конфигурационного файла
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получение данных из формы
        $name = $_POST['name'];
        $address = $_POST['address'];

        // Выполнение SQL-запроса для вставки данных об издательстве
        $query = "INSERT INTO publishers (name, address) VALUES ('$name', '$address')";

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
        // Если запрос не является POST, перенаправьте на страницу администрации
        header('Location: ../administration.php');
        exit();
    }
?>