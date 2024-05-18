<?php
    // Начало сессии
    session_start();

    // Подключение к базе данных
    $connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

    // Проверка соединения
    if ($connection == false) {
        echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
        echo mysqli_connect_error();
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySidee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .custom-file-input {
            position: relative;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            margin-bottom: 10px;
            z-index: 2;
            opacity: 0;
            cursor: pointer;
        }

        .custom-file-label {
            display: inline-block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            text-align: center;
        }

        .custom-file-label::after {
            content: 'Выберите файл';
            display: inline-block;
            padding: .375rem .75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #e9ecef;
            border-left: 1px solid #ced4da;
            border-radius: 0 .25rem .25rem 0;
            cursor: pointer;
        }

        .custom-file-label:hover::after {
            background-color: #dee2e6;
        }
    </style>
</head>

<body>
    <header>
        <div class="header">
            <div class="row">
                <div class="col-md-4 mt-2">
                    <!-- Кнопка для возврата на главную страницу -->
                    <a href="index.php" class="back-button">На главную</a>
                </div>
                <div class="col-md-4 mt-2">
                    <h1><img src="assets/images/logo.png" alt="logo" class="logo"> SideeVerse: Knowledge Hub</h1>
                </div>
                <div class="col-md-4 mt-2">
                </div>
            </div>
        </div>
    </header>

    <div class="login-container">
        <div class="row">
            <div class="col-md-4">
                <h2>Форма ввода данных о книгах</h2>
                <!-- Форма для добавления книги -->
                <form action="includes/process_book_data.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Название книги:</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="text">Описание:</label>
                        <input type="text" id="text" name="text" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="author_id">ID автора:</label>
                        <input type="number" id="author_id" name="author_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="genre_id">ID жанра:</label>
                        <input type="number" id="genre_id" name="genre_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="country_id">ID страны:</label>
                        <input type="number" id="country_id" name="country_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="publication_date">Год выпуска:</label>
                        <input type="text" id="publication_date" name="publication_date" class="form-control" required title="Год выпуска в формате ГГГГ-ММ-ДД">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Количество книг:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="publisher_id">ID издательства:</label>
                        <input type="number" id="publisher_id" name="publisher_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Изображение:</label>
                        <div class="position-relative">
                            <input type="file" id="image" name="image" class="custom-file-input" required>
                            <label class="custom-file-label" for="image"></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить книгу</button>
                </form>
                <br><br><br><br><br><br><br>

                <h2>Форма ввода данных об авторах</h2>
                <!-- Форма для добавления автора -->
                <form action="includes/process_author_data.php" method="post">
                    <div class="form-group">
                        <label for="first_name">Имя автора:</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Фамилия автора:</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <button type="submit">Добавить автора</button>
                </form>
                <br><br><br><br><br><br><br>

                <h2>Форма ввода данных об издательствах</h2>
                <!-- Форма для добавления издательства -->
                <form action="includes/process_publisher_data.php" method="post">
                    <div class="form-group">
                        <label for="name">Название издательства:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Фактический адрес издательства:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <button type="submit">Добавить издательство</button>
                </form>
                <br><br><br><br><br><br><br>

                <h2>Форма ввода данных о странах</h2>
                <!-- Форма для добавления страны -->
                <form action="includes/process_country_data.php" method="post">
                    <div class="form-group">
                        <label for="country_name">Наименование страны:</label>
                        <input type="text" id="country_name" name="country_name" required>
                    </div>
                    <button type="submit">Добавить страну</button>
                </form>
                <br><br><br><br><br><br><br>

                <h2>Форма ввода данных о жанрах</h2>
                <!-- Форма для добавления жанра -->
                <form action="includes/process_genre_data.php" method="post">
                    <div class="form-group">
                        <label for="genre_name">Наименование жанра:</label>
                        <input type="text" id="genre_name" name="genre_name" required>
                    </div>
                    <button type="submit">Добавить жанр</button>
                </form>
            </div>

            <div class="col-md-8">
                <!-- Таблицы для отображения данных -->
                <h2>Данные о книгах</h2>
                <div style="height: 775px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Изображение</th>
                                <th>ID автора</th>
                                <th>ID жанра</th>
                                <th>ID страны</th>
                                <th>Дата публикации</th>
                                <th>ID издательства</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Запрос данных о книгах
                                $query1 = "SELECT * FROM books";
                                $t1 = mysqli_query($connection, $query1);

                                if (!$t1) {
                                    die("Ошибка запроса: " . mysqli_error($connection));
                                }

                                // Вывод данных о книгах
                                while ($row1 = mysqli_fetch_assoc($t1)) {
                                    echo "<tr>";
                                    echo "<td>" . $row1['book_id'] . "</td>";
                                    echo "<td>" . $row1['title'] . "</td>";
                                    echo "<td>" . substr($row1['text'], 0, 50) . "..." . "</td>";
                                    echo "<td>" . $row1['image'] . "</td>";
                                    echo "<td>" . $row1['author_id'] . "</td>";
                                    echo "<td>" . $row1['genre_id'] . "</td>";
                                    echo "<td>" . $row1['country_id'] . "</td>";
                                    echo "<td>" . $row1['publication_date'] . "</td>";
                                    echo "<td>" . $row1['publisher_id'] . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br><br><br><br><br><br>

                <h2>Данные об авторах</h2>
                <div style="height: 250px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID автора</th>
                                <th>Имя автора</th>
                                <th>Фамилия автора</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Запрос данных об авторах
                                $query2 = "SELECT * FROM authors";
                                $t2 = mysqli_query($connection, $query2);

                                if (!$t2) {
                                    die("Ошибка запроса: " . mysqli_error($connection));
                                }

                                // Вывод данных об авторах// Вывод данных об авторах
                                while ($row2 = mysqli_fetch_assoc($t2)) {
                                    echo "<tr>";
                                    echo "<td>" . $row2['author_id'] . "</td>";
                                    echo "<td>" . $row2['first_name'] . "</td>";
                                    echo "<td>" . $row2['last_name'] . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br><br><br><br><br><br>

                <h2>Данные о издательствах</h2>
                <div style="height: 250px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID издательства</th>
                                <th>Наименование издательства</th>
                                <th>Фактический адрес издательства</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Запрос данных об издательствах
                                $query3 = "SELECT * FROM publishers";
                                $t3 = mysqli_query($connection, $query3);

                                if (!$t3) {
                                    die("Ошибка запроса: " . mysqli_error($connection));
                                }

                                // Вывод данных об издательствах
                                while ($row3 = mysqli_fetch_assoc($t3)) {
                                    echo "<tr>";
                                    echo "<td>" . $row3['publisher_id'] . "</td>";
                                    echo "<td>" . $row3['name'] . "</td>";
                                    echo "<td>" . $row3['address'] . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br><br><br><br><br><br>

                <h2>Данные о странах</h2>
                <div style="height: 200px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID страны</th>
                                <th>Название страны</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Запрос данных о странах
                                $query4 = "SELECT * FROM country";
                                $t4 = mysqli_query($connection, $query4);

                                if (!$t4) {
                                    die("Ошибка запроса: " . mysqli_error($connection));
                                }

                                // Вывод данных о странах
                                while ($row4 = mysqli_fetch_assoc($t4)) {
                                    echo "<tr>";
                                    echo "<td>" . $row4['country_id'] . "</td>";
                                    echo "<td>" . $row4['country_name'] . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br><br><br><br><br>

                <h2>Данные о жанрах</h2>
                <div style="height: 200px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID жанра</th>
                                <th>Жанр</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Запрос данных о жанрах
                            $query5 = "SELECT * FROM genres";
                            $t5 = mysqli_query($connection, $query5);

                            if (!$t5) {
                                die("Ошибка запроса: " . mysqli_error($connection));
                            }

                            // Вывод данных о жанрах
                            while ($row5 = mysqli_fetch_assoc($t5)) {
                                echo "<tr>";
                                echo "<td>" . $row5['genre_id'] . "</td>";
                                echo "<td>" . $row5['genre_name'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12"><br><br></div>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>SideeVerse: Knowledge Hub</h5>
                </div>
                <div class="col-md-3 text-right">
                    <h6><a href="project_details.php" class="footer-link">Сведения о проекте</a></h6>
                </div>
                <div class="col-md-3 text-right">
                    <h6><a href="feedback.php" class="footer-link">Обратная связь</a></h6>
                </div>
            </div>
        </div>
    </footer>

    <!-- Подключение Bootstrap JavaScript (если необходимо) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>