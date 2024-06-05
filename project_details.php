<?php
    // Подключение к базе данных
    $connection = mysqli_connect('127.0.0.1', 'root', '', 'TxpSidee');

    // Проверка соединения
    if($connection == false) {
        echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
        echo mysqli_connect_error();
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SideeVerse</title>
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
                    <h1><img src="assets/images/logo.png" alt="logo" class="logo"> SideeVerse: Knowledge Hub</h1>
                </div>
                <div class="col-md-4 mt-2">
                </div>
            </div>
        </div>
    </header>

    <!-- Контент страницы -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="qq-image img-fluid" src="assets/images/logo-v2.jpg" alt="logo-2">
            </div>
            <div class="col-md-8">
            <h5>Сведения о проекте</h5>

            <h5>Сведения о проекте</h5>

                <p>Добро пожаловать на страницу "Сведения о проекте"! <br>
                Этот программный модуль представляет собой функционирующий шаблон сайта, 
                созданный студентом 4 курса группы ИСПП-5 колледжа КС ПГУТИ – Угатьевым Евгением Владимировичем.</p>

                <h5>Описание проекта</h5>

                <p>Проект "SideeVerse: Knowledge Hub" был создан с целью разработки программного модуля для интернет библиотеки. <br>
                Основная задача – облегчить доступ к разнообразным литературным материалам, 
                сделать процесс поиска и оформления литературы максимально удобным и эффективным для всех пользователей.</p>

                <h5>История проекта</h5>

                <p>Проект начался как идея улучшения доступа к литературным ресурсам. 
                Мы стремились создать удобную и интуитивно понятную платформу, которая помогла бы пользователям находить необходимую литературу.</p>

                <h5>Разработчик</h5>

                <p>Проект "SideeVerse: Knowledge Hub" разработан и поддерживается одним человеком:
                Угатьев Евгений Владимирович (студент группы 4 ИСПП-5)</p>

                <h5>Технологии</h5>

                <p>При разработке проекта были использованы современные технологии и инструменты, чтобы обеспечить высокий 
                уровень функциональности и удобства использования. Это включает в себя:</p>
                <p> - HTML, CSS и JavaScript для создания пользовательского интерфейса
                <br> - PHP и MySQL для обработки данных и хранения информации о книгах
                <br> - Bootstrap для улучшения дизайна и адаптивности сайта
                <br> - И другие инструменты и библиотеки, способствующие развитию проекта</p>

                <h5>Ценности и миссия</h5>

                <p>Миссия проекта – сделать литературу доступной и удобной для всех пользователей. 
                Мы верим в силу знаний и стремимся помочь людям достигать успеха, 
                предоставляя доступ к обширной библиотеке разнообразных литературных материалов.</p>

                <h5>Планы на будущее</h5>

                <p>Мы работаем над постоянным улучшением нашего проекта и планируем добавить новые функции и возможности в будущем. 
                Наши планы включают в себя:
                Расширение коллекции книг
                Внедрение дополнительных возможностей для пользователей
                Повышение уровня безопасности и надежности сайта</p>

                <h6>Спасибо за то, что вы с нами! Мы надеемся, что наш проект будет полезен для вас и поможет вам в саморазвитии.</h6>

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

    <!-- Подключение Bootstrap JavaScript (если необходимо) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>