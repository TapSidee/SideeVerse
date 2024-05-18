<?php
// Подключение к базе данных
$connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

// Проверка соединения
if($connection == false) {
    echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
    echo mysqli_connect_error();
    exit();
}

// Начало сессии
session_start();
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

        .pagination .active .page-link {
            z-index: 1;
            position: relative;
            background-color: #007bff; /* Цвет фона для активной страницы */
            color: #fff; /* Цвет текста для активной страницы */
            border-color: #007bff; /* Цвет границы для активной страницы */
        }

        .btn-secondary-custom {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            margin-left: 1px; /* Добавляем отступ между кнопками */
        }

        .btn-secondary-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: #fff;
        }

        .header .logo {
            max-width: 50px;
            margin-right: 10px;
        }

        .header h1 {
            display: flex;
            align-items: center;
        }

        .header h1 span {
            font-size: 38x;
        }
        .custom-button-primary {
            border: 1px solid rgba(0, 123, 255, 0.5) !important; /* Рамка на пол оттенка темнее синего цвета */
        }

        .custom-button-secondary {
            border: 1px solid rgba(108, 117, 125, 0.5) !important; /* Рамка на пол оттенка темнее серого цвета */
            margin-left: 1px; /* Добавляем отступ между кнопками */
        }
    </style>
</head>
<body>
    <header>
        <div class="header">
            <div class="row">
                <div class="col-md-3 mt-2"></div>
                <div class="col-md-5 mt-2">
                    <h1><img src="assets/images/logo.png" alt="logo" class="logo"> <span>SideeVerse: Knowledge Hub</span></h1>
                </div>
                <div class="col-md-4 mt-2">
                    <?php if(isset($_SESSION['auth']) && $_SESSION['auth'] === true): ?>
                        <?php if($_SESSION['role'] === 'user'): ?>
                            <a href="profile.php" class="btn btn-primary">Profile</a>
                            <a href="logout.php" class="btn btn-primary">Logout</a>
                        <?php elseif($_SESSION['role'] === 'admin'): ?>
                            <a href="administration.php" class="btn btn-primary">Administration</a>
                            <a href="logout.php" class="btn btn-primary">Logout</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary">Authorization</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <form action="index.php" method="GET" class="form-inline">
                        <div class="input-group" style="width: 100%;">
                            <input type="text" name="search" placeholder="Поиск по названию или автору" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary custom-button-primary">Найти</button>
                                <button type="button" onclick="resetFilters()" class="btn btn-secondary-custom custom-button-secondary">Сбросить</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        <?php
                            // Определение параметров сортировки и поиска
                            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
                            $genre_id = isset($_GET['genre_id']) ? mysqli_real_escape_string($connection, $_GET['genre_id']) : '';
                            $country_id = isset($_GET['country_id']) ? mysqli_real_escape_string($connection, $_GET['country_id']) : '';
                            $searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

                            // Пагинация
                            $itemsPerPage = 10;
                            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($currentPage - 1) * $itemsPerPage;

                            // Сборка SQL-запроса с учетом пагинации и фильтров
                            $query = "SELECT * FROM books";
                            $countQuery = "SELECT COUNT(*) AS total FROM books";
                            $whereClause = [];

                            if (!empty($sort) && $sort === 'genre' && !empty($genre_id)) {
                                $whereClause[] = "genre_id = $genre_id";
                            }

                            if (!empty($sort) && $sort === 'country' && !empty($country_id)) {
                                $whereClause[] = "country_id = $country_id";
                            }

                            if (!empty($searchTerm)) {
                                $whereClause[] = "title LIKE '%$searchTerm%' OR author_id IN (SELECT author_id FROM authors WHERE CONCAT(first_name, ' ', last_name) LIKE '%$searchTerm%')";
                            }

                            if (!empty($whereClause)) {
                                $query .= " WHERE " . implode(" AND ", $whereClause);
                                $countQuery .= " WHERE " . implode(" AND ", $whereClause);
                            }

                            $query .= " LIMIT $offset, $itemsPerPage";

                            $result = mysqli_query($connection, $query);
                            if (!$result) {
                                die("Ошибка запроса: " . mysqli_error($connection));
                            }

                            // Вывод результатов
                            if (mysqli_num_rows($result) > 0) {
                                while ($book = mysqli_fetch_assoc($result)) {
                                    // Выполняем запросы для получения полного имени автора, названия жанра и страны
                                    $authorQuery = "SELECT CONCAT(first_name, ' ', last_name) AS full_name FROM authors WHERE author_id = " . $book['author_id'];
                                    $genreQuery = "SELECT genre_name FROM genres WHERE genre_id = " . $book['genre_id'];
                                    $countryQuery = "SELECT country_name FROM country WHERE country_id = " . $book['country_id'];

                                    $authorResult = mysqli_query($connection, $authorQuery);
                                    $genreResult = mysqli_query($connection, $genreQuery);
                                    $countryResult = mysqli_query($connection, $countryQuery);

                                    if (!$authorResult || !$genreResult || !$countryResult) {
                                        die("Ошибка запроса: " . mysqli_error($connection));
                                    }

                                    // Используем mysqli_fetch_assoc для получения данных из результатов запроса
                                    $authorData = mysqli_fetch_assoc($authorResult);
                                    $genreData = mysqli_fetch_assoc($genreResult);
                                    $countryData = mysqli_fetch_assoc($countryResult);

                                    // Используем полученные данные для вывода на страницу
                                    $authorFullName = $authorData['full_name'];
                                    $genreName = $genreData['genre_name'];
                                    $countryName = $countryData['country_name'];
                                ?>

                                <!-- HTML-код для вывода информации о книге -->
                                <div class="col-md-3 card-container">
                                    <a href="book-details.php?book_id=<?php echo $book['book_id']; ?>">
                                        <img src="assets/images/<?php echo $book['image']; ?>" alt="Изображение книги" class="card-image">
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="book-details.php?book_id=<?php echo $book['book_id']; ?>" style="text-decoration: none; color: inherit;">
                                                    <?php echo $book['title']; ?>
                                                </a>
                                            </h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Автор: <?php echo $authorFullName; ?></h6>
                                            <p class="card-text mb-2 text-muted">Год выпуска: <?php echo $book['publication_date']; ?><br>Страна: <?php echo $countryName; ?><br>Жанр: <?php echo $genreName; ?></p>
                                            <p class="card-text smaller-description"><?php echo $book['text']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else {
                            echo "Книги не найдены.";
                        }
                        ?>

                        <?php
                            // Пагинационные кнопки
                            $totalPagesQuery = mysqli_query($connection, $countQuery);
                            $totalPages = ceil(mysqli_fetch_assoc($totalPagesQuery)['total'] / $itemsPerPage);
                        ?>

                        <div class="col-md-12">
                            <nav aria-label="Страницы">
                                <ul class="pagination justify-content-center">
                                    <?php if ($currentPage > 1) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Предыдущая">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                        <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($currentPage < $totalPages) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Следующая">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-3">
                    <!-- Сайдбар с жанрами -->
                    <div class="sidebar-card">
                        <div class="card-body">
                            <h5>Жанры:</h5>
                            <ul>
                                <li><a href="index.php">Все жанры</a></li>
                                <?php
                                    // Запрос для получения жанров
                                    $genreQuery = "SELECT genre_id, genre_name FROM genres";
                                    $genreResult = mysqli_query($connection, $genreQuery);

                                    if (!$genreResult) {
                                        die("Ошибка запроса: " . mysqli_error($connection));
                                    }

                                    // Вывод жанров
                                    while ($genre = mysqli_fetch_assoc($genreResult)) {
                                        echo '<li><a href="?sort=genre&genre_id=' . $genre['genre_id'] . '">' . $genre['genre_name'] . '</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div><br>

                    <!-- Сайдбар со странами -->
                    <div class="sidebar-card">
                        <div class="card-body">
                            <h5>Страны:</h5>
                            <ul>
                                <li><a href="index.php">Все страны</a></li>
                                <?php
                                // Запрос для получения стран
                                $countryQuery = "SELECT country_id, country_name FROM country";
                                $countryResult = mysqli_query($connection, $countryQuery);

                                if (!$countryResult) {
                                    die("Ошибка запроса: " . mysqli_error($connection));
                                }

                                // Вывод стран
                                while ($country = mysqli_fetch_assoc($countryResult)) {
                                    echo '<li><a href="?sort=country&country_id=' . $country['country_id'] . '">' . $country['country_name'] . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    // Функция для сброса фильтров и перезагрузки страницы
    function resetFilters() {
        document.querySelector('input[name="search"]').value = '';
        window.location.href = 'index.php';
    }
    </script>

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

    <script src="your_script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
