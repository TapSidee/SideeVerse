<!DOCTYPE html>
<html lang="ru">
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
            <!-- Ссылка для возврата на главную страницу -->
            <a href="index.php" class="back-button">На главную</a>
        </div>
        <div class="login-container">
            <h2>Регистрация</h2>
            <!-- Форма регистрации пользователя -->
            <form action="includes/process_registration.php" method="post">
                <!-- Поле для ввода имени пользователя -->
                <div class="form-group">
                    <label for="first_name">Имя пользователя:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <!-- Поле для ввода фамилии пользователя -->
                <div class="form-group">
                    <label for="last_name">Фамилия пользователя:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <!-- Поле для ввода никнейма пользователя -->
                <div class="form-group">
                    <label for="username">Никнейм пользователя:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <!-- Поле для ввода электронной почты -->
                <div class="form-group">
                    <label for="email">Адрес электронной почты:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <!-- Поле для ввода пароля -->
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <!-- Кнопка для отправки формы регистрации -->
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
            </form>
            <!-- Ссылка на страницу входа для уже зарегистрированных пользователей -->
            <p>Уже есть аккаунт? <a href="login.php">Войдите</a></p>
        </div>
    </div>
</body>
</html>