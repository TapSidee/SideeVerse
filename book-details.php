<?php
session_start();
$connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

if ($connection == false) {
    echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
    echo mysqli_connect_error();
    exit();
}

// Проверка авторизации пользователя
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    die('Пожалуйста, авторизуйтесь.');
}

$userId = $_SESSION['user_id'];
$bookId = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;

// Выполнение SQL-запроса для получения данных о книге
$query = "SELECT * FROM books WHERE book_id = $bookId";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $bookData = mysqli_fetch_assoc($result);

    // Получение данных об авторе
    $authorId = $bookData['author_id'];
    $authorQuery = "SELECT first_name, last_name FROM authors WHERE author_id = $authorId";
    $authorResult = mysqli_query($connection, $authorQuery);
    $authorData = $authorResult ? mysqli_fetch_assoc($authorResult) : null;

    // Получение данных об издательстве
    $publisherId = $bookData['publisher_id'];
    $publisherQuery = "SELECT name FROM Publishers WHERE publisher_id = $publisherId";
    $publisherResult = mysqli_query($connection, $publisherQuery);
    $publisherData = $publisherResult ? mysqli_fetch_assoc($publisherResult) : null;

    // Получение данных о жанре
    $genreId = $bookData['genre_id'];
    $genreQuery = "SELECT genre_name FROM Genres WHERE genre_id = $genreId";
    $genreResult = mysqli_query($connection, $genreQuery);
    $genreData = $genreResult ? mysqli_fetch_assoc($genreResult) : null;

    // Получение данных о стране
    $countryId = $bookData['country_id'];
    $countryQuery = "SELECT country_name FROM country WHERE country_id = $countryId";
    $countryResult = mysqli_query($connection, $countryQuery);
    $countryData = $countryResult ? mysqli_fetch_assoc($countryResult) : null;

    // Извлечение года из publication_date
    $publicationYear = date('Y', strtotime($bookData['publication_date']));

    // Получение статуса прочтения книги
    $statusQuery = "SELECT status FROM user_book_status WHERE user_id = $userId AND book_id = $bookId";
    $statusResult = mysqli_query($connection, $statusQuery);
    $statusData = $statusResult ? mysqli_fetch_assoc($statusResult) : null;
    $currentStatus = $statusData ? $statusData['status'] : 'не прочитано';
} else {
    die("Книга не найдена.");
}

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
            <form method="POST" action="">
                <label for="status">Статус прочтения:</label>
                <select name="status" id="status" class="form-control" style="width:100%;">
                    <option value="не прочитано" <?php if ($currentStatus == 'не прочитано') echo 'selected'; ?>>не прочитано</option>
                    <option value="в планах" <?php if ($currentStatus == 'в планах') echo 'selected'; ?>>в планах</option>
                    <option value="читаю" <?php if ($currentStatus == 'читаю') echo 'selected'; ?>>читаю</option>
                    <option value="прочитано" <?php if ($currentStatus == 'прочитано') echo 'selected'; ?>>прочитано</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
            </form>
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