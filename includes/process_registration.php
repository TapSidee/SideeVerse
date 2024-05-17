<?php
    // Подключение конфигурационного файла
    require 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Получение данных из формы
        $first_name = mysqli_real_escape_string($connection, $_POST["first_name"]);
        $last_name = mysqli_real_escape_string($connection, $_POST["last_name"]);
        $username = mysqli_real_escape_string($connection, $_POST["username"]); // добавлен никнейм
        $email = mysqli_real_escape_string($connection, $_POST["email"]);
        $password = mysqli_real_escape_string($connection, $_POST["password"]);
        $hashed_password = md5($password); // Хеширование пароля перед сохранением в базу данных

        // SQL-запрос для вставки данных в таблицу users
        $sql = "INSERT INTO users (first_name, last_name, username, email, password)
                VALUES ('$first_name', '$last_name', '$username', '$email', '$hashed_password')";

        if ($connection->query($sql) === TRUE) {
            // Редирект на страницу входа
            header("Location: ../login.php");
            exit();
        } else {
            echo "Ошибка при регистрации: " . $connection->error;
        }

        $connection->close();
    }
?>
