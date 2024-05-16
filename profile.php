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

$userQuery = "SELECT * FROM users WHERE id_user = $userId";
$userResult = mysqli_query($connection, $userQuery);

if ($userResult && mysqli_num_rows($userResult) > 0) {
    $userData = mysqli_fetch_assoc($userResult);
} else {
    die('Пользователь не найден.');
}

$statuses = ['в планах', 'читаю', 'прочитано'];
$booksByStatus = [];

foreach ($statuses as $status) {
    $statusQuery = "SELECT books.title FROM user_book_status 
                    JOIN books ON user_book_status.book_id = books.book_id 
                    WHERE user_book_status.user_id = $userId AND user_book_status.status = '$status'";
    $statusResult = mysqli_query($connection, $statusQuery);
    if ($statusResult) {
        $booksByStatus[$status] = mysqli_fetch_all($statusResult, MYSQLI_ASSOC);
    } else {
        $booksByStatus[$status] = [];
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySidee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .profile-container {
            display: flex;
            justify-content: space-between;
            gap: 4px;
        }

        .profile-info, .reading-stats {
            padding: 20px;
            background-color: #fff;
        }

        .profile-info {
            flex: 0 0 65%;
            max-width: 65%;
            display: flex;
            /* border: 1px solid #dee2e6; */
            border-radius: 0.25rem;
            align-items: flex-start;
            margin-bottom: 0px; /* Добавлено смещение нижней границы */
        }

        .reading-stats {
            flex: 0 0 30%;
            max-width: 30%;
            margin-bottom: 0px; /* Добавлено смещение нижней границы */
        }

        .profile-info .avatar {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .profile-info img {
            width: 100%;
            height: auto;
            border-radius: 0.25rem;
        }

        .profile-info .personal-info {
            flex: 1;
            margin-left: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
        }

        .card-body ul {
            list-style-type: none;
            padding-left: 0;
        }

        .card-body ul li {
            padding: 5px 0;
        }

        .card-body ul li:not(:last-child) {
            border-bottom: 1px solid #dee2e6;
        }

        .card-body {
            max-height: 300px; /* Увеличиваем высоту для отображения большего количества книг */
            overflow-y: auto; /* Добавляем прокрутку, если контент превышает максимальную высоту */
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
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <div class="profile-container">
            <div class="profile-info">
                <div class="avatar">
                    <img src="uploads/avatars/<?php echo $_SESSION['avatar']; ?>" alt="Avatar">
                </div>
                <div class="personal-info">
                    <p><strong>Имя:</strong> <?php echo $userData['first_name']; ?></p>
                    <p><strong>Фамилия:</strong> <?php echo $userData['last_name']; ?></p>
                    <p><strong>Имя пользователя:</strong> <?php echo $userData['username']; ?></p>
                    <p><strong>Эл. почта:</strong> <?php echo $userData['email']; ?></p>
                    <a href="edit_profile.php" class="btn btn-primary mt-2">Изменить данные</a>
                </div>
            </div>
            <div class="reading-stats">
                <!-- <h3>Статистика чтения книг</h3> -->
                <?php foreach ($statuses as $status): ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4><?php echo ucfirst($status); ?></h4>
                        </div>
                        <div class="card-body">
                            <ul>
                                <?php if (empty($booksByStatus[$status])): ?>
                                    <li>Нет книг с этим статусом</li>
                                <?php else: ?>
                                    <?php foreach ($booksByStatus[$status] as $book): ?>
                                        <li><?php echo $book['title']; ?></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer class="footer mt-4">
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

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
