<?php
    session_start();
    $link = mysqli_connect('localhost', 'root', '', 'TxpSidee');
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
<style>
    background-image: url("https://sun9-56.userapi.com/impg/EgZTCJ0LRnq98Swx8fSeWMUYWo4TEGJqKOvt3Q/hsL-1WWF4l0.jpg?size=2560x1440&quality=96&sign=f4263c53a265858407a8eb2d098ad8e7&type=album");
</style>
<body class="login-page">
    <div class="grid-container">
        <div class="col-md-3 mt-2">
            <a href="index.php" class="back-button">На главную</a>
        </div>
        <div class="login-container">
            <h2>Вход</h2>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Имя пользователя:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Войти</button>
            </form>

<?php
if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = md5($_POST['password']); // Хешируем пароль

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($link, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $rrr = mysqli_fetch_assoc($result);

        $_SESSION['auth'] = true;
        $_SESSION['username'] = $rrr['username'];
        $role = $rrr['role'];

        if($role == 'user') { 
            $_SESSION['role'] = 'user'; 
            header("Location: index.php");
            exit();
        } elseif ($role == 'admin') { 
            $_SESSION['role'] = 'admin'; 
            header("Location: administration.php");
            exit();
        }
    } else {
        echo '<p class="error">Неверный логин и/или пароль</p>';
    }
}

?>

            <p>Еще нет аккаунта? <a href="registration.php">Зарегистрируйтесь</a></p>
        </div>
    </div>
</body>
</html>