<?php
session_start();
$connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

if ($connection == false) {
    echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
    echo mysqli_connect_error();
    exit();
}

// Получение book_id из параметра URL
$bookId = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;

// Выполнение SQL-запроса для получения данных о книге
$query = "SELECT * FROM books WHERE book_id = $bookId";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $bookData = mysqli_fetch_assoc($result);

    // Теперь выполните запрос для получения данных об авторе
    $authorId = $bookData['author_id'];
    $authorQuery = "SELECT first_name, last_name FROM authors WHERE author_id = $authorId";
    $authorResult = mysqli_query($connection, $authorQuery);
    $authorData = mysqli_fetch_assoc($authorResult);

    // Теперь выполните запрос для получения данных об издательстве
    $publisherId = $bookData['publisher_id'];
    $publisherQuery = "SELECT name FROM Publishers WHERE publisher_id = $publisherId";
    $publisherResult = mysqli_query($connection, $publisherQuery);
    $publisherData = mysqli_fetch_assoc($publisherResult);

    // Теперь выполните запрос для получения данных о жанре
    $genreId = $bookData['genre_id'];
    $genreQuery = "SELECT genre_name FROM Genres WHERE genre_id = $genreId";
    $genreResult = mysqli_query($connection, $genreQuery);
    $genreData = mysqli_fetch_assoc($genreResult);

    // Теперь выполните запрос для получения данных о стране
    $countryId = $bookData['country_id'];
    $countryQuery = "SELECT country_name FROM country WHERE country_id = $countryId";
    $countryResult = mysqli_query($connection, $countryQuery);
    $countryData = mysqli_fetch_assoc($countryResult);

    // Извлечение года из publication_date
    $publicationYear = date('Y', strtotime($bookData['publication_date']));

    // Вывод других данных о книге
} else {
    // Обработка случая, если книга не найдена
    echo "Книга не найдена.";
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
</head>

<body>

<header>
    <div class="header">
        <div class="row">
            <div class="col-md-4 mt-2">
                <a href="index.php" class="back-button">На главную</a>
            </div>
            <div class="col-md-4 mt-2">
                <h1><img src="assets/images/logo.png" alt="logo" class="logo"> LibrarySidee - Student library</h1>
            </div>
            <div class="col-md-4 mt-2">
            </div>
        </div>
    </div>
</header>

<!-- Контент страницы -->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img class="card-image" src="assets/images/<?php echo $bookData['image']; ?>" alt="Изображение книги">
        </div>
        <div class="col-md-9">
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
</div>

<div class="col-md-12"><br><br></div>
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>LibrarySidee - Student library</h5>
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
