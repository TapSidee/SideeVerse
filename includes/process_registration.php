<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $id_user = mysqli_real_escape_string($connection, $_POST["id_user"]);
    $first_name = mysqli_real_escape_string($connection, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($connection, $_POST["last_name"]);
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]); 

    // SQL-запрос для вставки данных в таблицу users
    $sql = "INSERT INTO users (id_user, first_name, last_name, username, email, password)
            VALUES ($id_user, '$first_name', '$last_name', '$username', '$email', '$password')";

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