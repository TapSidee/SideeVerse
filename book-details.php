<?php
session_start();
$connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

if ($connection == false) {
    echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
    echo mysqli_connect_error();
    exit();
}

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    die('Пожалуйста, авторизуйтесь.');
}

$userId = $_SESSION['user_id'];
$bookId = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;

$query = "SELECT * FROM books WHERE book_id = $bookId";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $bookData = mysqli_fetch_assoc($result);

    $authorId = $bookData['author_id'];
    $authorQuery = "SELECT first_name, last_name FROM authors WHERE author_id = $authorId";
    $authorResult = mysqli_query($connection, $authorQuery);
    $authorData = $authorResult ? mysqli_fetch_assoc($authorResult) : null;

    $publisherId = $bookData['publisher_id'];
    $publisherQuery = "SELECT name FROM Publishers WHERE publisher_id = $publisherId";
    $publisherResult = mysqli_query($connection, $publisherQuery);
    $publisherData = $publisherResult ? mysqli_fetch_assoc($publisherResult) : null;

    $genreId = $bookData['genre_id'];
    $genreQuery = "SELECT genre_name FROM Genres WHERE genre_id = $genreId";
    $genreResult = mysqli_query($connection, $genreQuery);
    $genreData = $genreResult ? mysqli_fetch_assoc($genreResult) : null;

    $countryId = $bookData['country_id'];
    $countryQuery = "SELECT country_name FROM country WHERE country_id = $countryId";
    $countryResult = mysqli_query($connection, $countryQuery);
    $countryData = $countryResult ? mysqli_fetch_assoc($countryResult) : null;

    $publicationYear = date('Y', strtotime($bookData['publication_date']));

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

// Получение похожих книг
$similarBooks = [];
$similarQueries = [
    "SELECT * FROM books WHERE author_id = $authorId AND book_id != $bookId ORDER BY RAND() LIMIT 1",
    "SELECT * FROM books WHERE country_id = $countryId AND book_id != $bookId ORDER BY RAND() LIMIT 1",
    "SELECT * FROM books WHERE genre_id = $genreId AND book_id != $bookId ORDER BY RAND() LIMIT 1"
];

foreach ($similarQueries as $query) {
    $similarResult = mysqli_query($connection, $query);
    if ($similarResult && mysqli_num_rows($similarResult) > 0) {
        $similarBooks[] = mysqli_fetch_assoc($similarResult);
    }
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
        .card-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            aspect-ratio: 2 / 3;
        }
        .book-details {
            font-size: 18px;
        }
        .book-details h2, .book-details h6, .book-details p {
            font-size: 20px;
        }
        .book-details h2 {
            font-size: 26px;
        }
        .action-buttons {
            margin-bottom: 20px;
        }
        .action-buttons .btn {
            margin-right: 10px;
        }
        .similar-books {
            margin-top: 40px;
        }
        .similar-books h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .similar-books .card {
            margin-right: 10px;
            flex: 1;
            max-width: 18rem;
        }
        .similar-books .card-img {
            width: 100%;
            height: auto;
            object-fit: cover;
            aspect-ratio: 2 / 3;
        }
        .similar-books .card-title {
            font-size: 16px;
            text-align: center;
            margin-top: 10px;
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
                <h1><img src="assets/images/logo.png" alt="logo" class="logo"> LibrarySidee - Student library</h1>
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
        <div class="d-flex">
            <?php foreach ($similarBooks as $similarBook): ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-img">
                        <img src="assets/images/<?php echo $similarBook['image']; ?>" class="card-img-top" alt="<?php echo $similarBook['title']; ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $similarBook['title']; ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<br>
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