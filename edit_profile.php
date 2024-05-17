<?php
    // Начало сессии
    session_start();

    // Подключение к базе данных
    $connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

    // Проверка соединения
    if ($connection === false) {
        echo 'Не удалось подключиться к базе данных: ' . mysqli_connect_error();
        exit();
    }

    // Проверка отправки формы
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Защита от SQL-инъекций
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = !empty($_POST['password']) ? md5($_POST['password']) : null;

        // Обработка загрузки файла аватара
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = $_FILES['avatar']['name'];
            $avatar_tmp_name = $_FILES['avatar']['tmp_name'];
            $avatar_folder = 'uploads/avatars/';

            if (move_uploaded_file($avatar_tmp_name, $avatar_folder . $avatar)) {
                $avatar = mysqli_real_escape_string($connection, $avatar); // Защита от SQL инъекций для имени файла
            } else {
                echo '<div class="alert alert-danger text-center">Ошибка загрузки файла.</div>';
                $avatar = $_SESSION['avatar']; // Используем старый аватар, если загрузка не удалась
            }
        } else {
            $avatar = $_SESSION['avatar']; // Нет нового файла, используем старый
        }

        // Формирование запроса на обновление данных пользователя
        $update_query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username', email = '$email', avatar = '$avatar'";
        if ($password) {
            $update_query .= ", password = '$password'";
        }
        $update_query .= " WHERE id_user = " . $_SESSION['user_id'];
        $result = mysqli_query($connection, $update_query);

        if ($result) {
            // Обновление сессии
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['avatar'] = $avatar; // Сохраняем имя файла

            echo '<div class="alert alert-success text-center">Данные успешно обновлены.</div>';
        } else {
            echo '<div class="alert alert-danger text-center">Ошибка обновления данных: ' . mysqli_error($connection) . '</div>';
        }
    }

    // Получение текущих данных пользователя для формы
    $query = "SELECT first_name, last_name, username, email, avatar FROM users WHERE id_user = " . $_SESSION['user_id'];
    $userData = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($userData);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibrarySidee - Редактирование профиля</title>
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
                <div class="col-md-8 mt-2">
                    <h1><img src="assets/images/logo.png" alt="logo" class="logo"> LibrarySidee - Student library</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Редактировать профиль</h2>
                <!-- Форма редактирования профиля -->
                <form action="edit_profile.php" method="post" enctype="multipart/form-data" class="mb-3">
                    <div class="form-group">
                        Имя: <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        Фамилия: <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        Пользователь: <input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        Email: <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        Аватар: <input type="file" name="avatar" class="form-control">
                    </div>
                    <div class="form-group">
                        Пароль: <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
