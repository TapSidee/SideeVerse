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

    // Проверка авторизации пользователя
    if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
        die('Пожалуйста, авторизуйтесь.');
    }

    // Получение ID пользователя и книги из параметра GET
    $userId = $_SESSION['user_id'];
    $bookId = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;

    // Запрос данных книги
    $query = "SELECT * FROM books WHERE book_id = $bookId";
    $result = mysqli_query($connection, $query);

    // Проверка результата запроса данных книги
    if ($result && mysqli_num_rows($result) > 0) {
        $bookData = mysqli_fetch_assoc($result);

        // Запрос данных автора книги
        $authorId = $bookData['author_id'];
        $authorQuery = "SELECT first_name, last_name FROM authors WHERE author_id = $authorId";
        $authorResult = mysqli_query($connection, $authorQuery);
        $authorData = $authorResult ? mysqli_fetch_assoc($authorResult) : null;

        // Запрос данных издательства книги
        $publisherId = $bookData['publisher_id'];
        $publisherQuery = "SELECT name FROM publishers WHERE publisher_id = $publisherId";
        $publisherResult = mysqli_query($connection, $publisherQuery);
        $publisherData = $publisherResult ? mysqli_fetch_assoc($publisherResult) : null;

        // Запрос данных жанра книги
        $genreId = $bookData['genre_id'];
        $genreQuery = "SELECT genre_name FROM genres WHERE genre_id = $genreId";
        $genreResult = mysqli_query($connection, $genreQuery);
        $genreData = $genreResult ? mysqli_fetch_assoc($genreResult) : null;

        // Запрос данных страны книги
        $countryId = $bookData['country_id'];
        $countryQuery = "SELECT country_name FROM country WHERE country_id = $countryId";
        $countryResult = mysqli_query($connection, $countryQuery);
        $countryData = $countryResult ? mysqli_fetch_assoc($countryResult) : null;

        $publicationYear = date('Y', strtotime($bookData['publication_date']));

        // Запрос текущего статуса книги для пользователя
        $statusQuery = "SELECT status FROM user_book_status WHERE user_id = $userId AND book_id = $bookId";
        $statusResult = mysqli_query($connection, $statusQuery);
        $statusData = $statusResult ? mysqli_fetch_assoc($statusResult) : null;
        $currentStatus = $statusData ? $statusData['status'] : 'Не прочитано';
    } else {
        die("Книга не найдена.");
    }

    // Обработка формы изменения статуса книги
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newStatus = $_POST['status'];

        if ($statusData) {
            $updateStatusQuery = "UPDATE user_book_status SET status = '$newStatus' WHERE user_id = $userId AND book_id = $bookId";
            mysqli_query($connection, $updateStatusQuery);
        } else {
            $insertStatusQuery = "INSERT INTO user_book_status (user_id, book_id, status) VALUES ($userId, $bookId, '$newStatus')";
            mysqli_query($connection, $insertStatusQuery);
        }

        header("Location: book-details.php?book_id=$bookId");
        exit();
    }

    // Получение похожих книг
$similarBooks = [];
$authorId = $bookData['author_id'];
$genreId = $bookData['genre_id'];

// Получение книг того же автора, но не текущей книги
$authorQuery = "SELECT * FROM books WHERE author_id = $authorId AND book_id != $bookId ORDER BY RAND() LIMIT 1";
$authorResult = mysqli_query($connection, $authorQuery);
$authorBook = mysqli_fetch_assoc($authorResult);
if ($authorBook) {
    $similarBooks[] = $authorBook;
}

// Получение книг того же жанра, но не текущей книги и не книги того же автора
$genreQuery = "SELECT * FROM books WHERE genre_id = $genreId AND book_id != $bookId AND author_id != $authorId ORDER BY RAND() LIMIT 1";
$genreResult = mysqli_query($connection, $genreQuery);
$genreBook = mysqli_fetch_assoc($genreResult);
if ($genreBook) {
    $similarBooks[] = $genreBook;
}

// Получение случайных книг, исключая текущую книгу, книгу того же автора и книгу того же жанра
$randomQuery = "SELECT * FROM books WHERE book_id != $bookId AND author_id != $authorId AND genre_id != $genreId ORDER BY RAND() LIMIT 2";
$randomResult = mysqli_query($connection, $randomQuery);
while ($randomBook = mysqli_fetch_assoc($randomResult)) {
    $similarBooks[] = $randomBook;
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
        .main-book-image {
            width: 100%;
            height: auto; 
        }

        .book-card {
            flex: 1 1 calc(25% - 20px); /* Устанавливаем ширину карточек и отступ */
            box-sizing: border-box;
            margin-bottom: 20px;
            max-width: 18rem;
            margin-bottom: 20px; /* Увеличиваем отступ между карточками */
            margin-right: 2px; /* Добавляем отступ справа */
            margin-left: 2px; /* Добавляем отступ слева */
        }

        .book-card:hover {
            cursor: pointer; /* Делаем курсор при наведении на карточку */
        }

        .book-image {
            width: 100%;
            padding-top: 120%; 
            position: relative;
            overflow: hidden;
            height: 0; 
        }

        .book-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Сохраняем пропорции изображения */
        }

        .book-title {
            text-align: center;
            padding: 10px 0;
        }

        .similar-books {
            margin-top: 40px;
        }

        .similar-books h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .card-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            aspect-ratio: 100 / 120;
        }
        .footer {
            z-index: 0;
            position: relative;
            padding: 10px;
            bottom: 0;
            left: 0;
            right: 0;
            margin-top: 20px;
            color: #000;
        }
    </style>
</head>
<body>
<header>
    <div class="header">
        <div class="row">
            <div class="col-md-4 mt-2">
                <a href="index.php" class="back-button">На главную</a>
            </div>
            <div class="col-md-4 mt-2">
                <h1><img src="assets/images/logo.png" alt="logo" class="logo"> SideeVerse: Knowledge Hub</h1>
            </div>
            <div class="col-md-4 mt-2"></div>
        </div>
    </div>
</header>

<div class="container book-details">
    <div class="row">
        <div class="col-md-4">
            <img class="card-image" src="assets/images/<?php echo $bookData['image']; ?>" alt="Изображение книги">
            <div class="action-buttons"><br>
                <a href="read.php?title=<?php echo urlencode($bookData['title']); ?>" class="btn btn-secondary">Читать</a>
                <a href="assets/files/nan.pdf" class="btn btn-secondary" download>Скачать</a>
            </div>
            <form method="POST" action="">
                <br><label for="status"><h5>Статус прочтения:</h5></label>
                <select name="status" id="status" class="form-control" style="width:100%;">
                    <option value="Не прочитано" <?php if ($currentStatus == 'Не прочитано') echo 'selected'; ?>>Не прочитано</option>
                    <option value="Запланировано" <?php if ($currentStatus == 'Запланировано') echo 'selected'; ?>>Запланировано</option>
                    <option value="Читаю" <?php if ($currentStatus == 'Читаю') echo 'selected'; ?>>Читаю</option>
                    <option value="Прочитано" <?php if ($currentStatus == 'Прочитано') echo 'selected'; ?>>Прочитано</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
            </form>
        </div>
        <div class="col-md-8">
            <h2><?php echo $bookData['title']; ?></h2>
            <h6 class="book-subtitle mb-2 text-muted">Автор: <?php echo $authorData['first_name'] . ' ' . $authorData['last_name']; ?></h6>
            <h6 class="book-subtitle mb-2 text-muted">Издательство: <?php echo $publisherData['name']; ?></h6>
            <h6 class="book-subtitle mb-2 text-muted">Год выпуска издания: <?php echo $publicationYear; ?></h6>
            <h6 class="book-subtitle mb-2 text-muted">Страна: <?php echo $countryData['country_name']; ?></h6>
            <h6 class="book-subtitle mb-2 text-muted">Жанры: <?php echo $genreData['genre_name']; ?></h6>
            <h6 class="book-subtitle mb-2 text-muted">Описание книги:</h6>
            <p><?php echo $bookData['text']; ?></p>
        </div>
    </div>
    <div class="row similar-books">
        <div class="col-md-12">
            <h3>Похожие книги</h3>
            <div class="d-flex flex-wrap">
                <!-- Вывод похожих книг -->
                <?php foreach ($similarBooks as $similarBook): ?>
                    <div class="book-card" onclick="window.location='book-details.php?book_id=<?php echo $similarBook['book_id']; ?>';">
                        <!-- Карточка книги -->
                        <div class="book-image">
                            <img src="assets/images/<?php echo $similarBook['image']; ?>" class="card-img-top" alt="<?php echo $similarBook['title']; ?>">
                        </div>
                        <div class="book-title">
                            <h5 class="card-title"><?php echo $similarBook['title']; ?></h5>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- <br>
    <div class="col-md-12"><br><br></div> -->
    <!-- Footer -->
    <!-- <footer class="footer">
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
    </footer> -->

    <!-- Подключение Bootstrap JavaScript (если необходимо) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
