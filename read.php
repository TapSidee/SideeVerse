<?php
    // Получение названия книги из параметра GET, если он установлен, иначе присваивание значения по умолчанию
    $title = isset($_GET['title']) ? $_GET['title'] : 'Название книги не указано';
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
        .book-title {
            margin-top: 20px;
            text-align: center;
            font-size: 24px;
        }
        .back-button {
            margin: 20px;
        }
    </style>
</head>
<body>
<header>
    <div class="header">
        <div class="row">
            <div class="col-md-4 mt-2">
                <!-- Кнопка для возврата на предыдущую страницу -->
                <a href="javascript:history.back()" class="back-button">Назад</a>
            </div>
        </div>
    </div>
</header>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <!-- Вывод названия книги -->
            <h2 class="book-title"><?php echo htmlspecialchars($title); ?></h2>
            <p>Содержимое книги будет здесь...</p>
        </div>
    </div>
</div>

<div class="col-md-12"><br><br></div>
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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
