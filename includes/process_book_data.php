<?php
    // Подключение конфигурационного файла
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получение данных из формы
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $text = mysqli_real_escape_string($connection, $_POST['text']);
        $author_id = intval($_POST['author_id']);
        $genre_id = intval($_POST['genre_id']);
        $country_id = intval($_POST['country_id']);
        $publication_date = mysqli_real_escape_string($connection, $_POST['publication_date']);
        $publisher_id = intval($_POST['publisher_id']);

        // Обработка загрузки файла изображения
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = '../assets/images/';

            if (move_uploaded_file($image_tmp_name, $image_folder . $image)) {
                $image = mysqli_real_escape_string($connection, $image); // Защита от SQL инъекций для имени файла
            } else {
                echo '<div class="alert alert-danger text-center">Ошибка загрузки файла.</div>';
                $image = ''; // Используем пустое значение, если загрузка не удалась
            }
        } else {
            $image = ''; // Нет нового файла, используем пустое значение
        }

        // Выполнение SQL-запроса для вставки данных о книге
        $query = "INSERT INTO books (title, text, image, author_id, genre_id, country_id, publication_date, publisher_id)
                VALUES ('$title', '$text', '$image', $author_id, $genre_id, $country_id, '$publication_date', $publisher_id)";

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
