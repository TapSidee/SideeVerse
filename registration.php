<?php
$connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

if($connection == false)
{
    echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
    echo mysqli_connect_error();
    exit();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySidee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="login-page">
    <div class="grid-container">
        <div class="col-md-3 mt-2">
            <a href="index.php" class="back-button">На главную</a>
        </div>
        <div class="login-container">
            <h2>Регистрация<br></h2>
            <form action="includes/process_registration.php" method="post">
            <div class="form-group">
                    <label for="id_user">Номер студенческого билета:</label>
                    <input type="number" id="id_user" name="id_user" required>
                </div>
                <div class="form-group">
                    <label for="first_name">Имя студента:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия студента:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="username">Имя пользователя:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Адрес электронной почты:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Зарегистрироваться</button>
            </form>
            <p>Уже есть аккаунт? <a href="login.php">Войдите</a></p>
        </div>
    </div>
</body>
</html>