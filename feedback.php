<?php
$connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

if($connection == false)
{
    echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
    echo mysqli_connect_error();
    exit();
}
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
</head>

<body>

<header>
        <div class="header">
            <div class="row">
                <div class="col-md-3 mt-2">
                    <a href="index.php" class="back-button">На главную</a>
                </div>
                <div class="col-md-5 mt-2">
                <h1><img src="assets/images/logo.png" alt="logo" class="logo">   LibrarySidee - Student library</h1>
                </div>
                <div class="col-md-4 mt-2">
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] == 'success'): ?>
                        <div class="alert alert-success">Отзыв успешно отправлен! Спасибо за ваше мнение.</div>
                    <?php elseif ($_GET['status'] == 'error'): ?>
                        <div class="alert alert-danger">Произошла ошибка при отправке отзыва. Пожалуйста, попробуйте снова.</div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <h2>Обратная связь</h2>
                <form action="includes/process_feedback.php" method="POST">
                    <div class="form-group">
                        <label for="sender_name">Имя:</label>
                        <input type="text" class="form-control" id="sender_name" name="sender_name" required>
                    </div>
                    <div class="form-group">
                        <label for="sender_email">Email:</label>
                        <input type="email" class="form-control" id="sender_email" name="sender_email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Тема:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message_text">Сообщение:</label>
                        <textarea class="form-control" id="message_text" name="message_text" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
            <div class="col-md-6">
                <br><br><br><p>Также можете обратиться к нам иными способами</p>
                <p>Адрес:  38.8976763  -77.0365298</p>
                <p>Email:  skyewhowalker@gmail.com or shaoo0@gmail.com</p>
                <p>Телефон: 8 (846) 278-13-40</p>
                <p>Telegramm: TxpSidee_</p>
                <p>Vk: TxpSidee_</p>
                <p>Twitch: TxpSidee_</p>
                <p>GitHub: TxpSidee_</p>
            </div>
        </div>
    </div>

    <div class="col-md-12"><br><br></div>
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

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
