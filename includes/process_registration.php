<?php
// Подключение конфигурационного файла
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $first_name = mysqli_real_escape_string($connection, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($connection, $_POST["last_name"]);
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $hashed_password = md5($password); // Хеширование пароля перед сохранением в базу данных

    // Проверка на уникальность никнейма
    $check_username = "SELECT * FROM users WHERE username='$username'";
    $result = $connection->query($check_username);

    if ($result->num_rows > 0) {
        // Никнейм занят
        header("Location: ../registration.php?error=Никнейм занят");
        exit();
    } else {
        // SQL-запрос для вставки данных в таблицу users
        $sql = "INSERT INTO users (first_name, last_name, username, email, password)
                VALUES ('$first_name', '$last_name', '$username', '$email', '$hashed_password')";

        if ($connection->query($sql) === TRUE) {
            // Редирект на страницу входа
            header("Location: ../login.php");
            exit();
        } else {
            header("Location: ../registration.php?error=Ошибка при регистрации: " . $connection->error);
            exit();
        }
    }

    $connection->close();
}
?>
