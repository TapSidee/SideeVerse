<?php
session_start();
$connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

if ($connection == false) {
    echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
    echo mysqli_connect_error();
    exit();
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
        <div class="row profile-container">
            <div class="col-md-4">
                <div class="avatar">
                <img src="uploads/avatars/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" style="width:100%;">
                </div>
            </div>
            <div class="col-md-8">
                <div class="personal-info">
                    <p>Имя: <?php echo $_SESSION['first_name']; ?></p>
                    <p>Фамилия: <?php echo $_SESSION['last_name']; ?></p>
                    <p>Имя пользователя: <?php echo $_SESSION['username']; ?></p>
                    <p>Эл. почта: <?php echo $_SESSION['email']; ?></p>
                </div>
                <a href="edit_profile.php" class="btn btn-primary mt-2">Изменить данные</a>
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
