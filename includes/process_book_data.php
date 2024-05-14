<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $title = $_POST['title'];
    $text = $_POST['text'];
    $image = $_POST['image'];
    $author_id = $_POST['author_id'];
    $genre_id = $_POST['genre_id'];
    $country_id = $_POST['country_id'];
    $publication_date = $_POST['publication_date'];
    $quantity = $_POST['quantity'];
    $publisher_id = $_POST['publisher_id'];

    // Выполнение SQL-запроса для вставки данных о книге
    $query = "INSERT INTO books (title, text, image, author_id, genre_id, country_id, publication_date, quantity, publisher_id)
              VALUES ('$title', '$text', '$image', $author_id, $genre_id, $country_id, '$publication_date', $quantity, $publisher_id)";

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