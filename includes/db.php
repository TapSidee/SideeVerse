<?php

    // Подключение конфигурационного файла
    require "config.php";

    // Подключение к базе данных с использованием параметров из конфигурационного файла
    $connection = mysqli_connect(
        $config['db']['server'],
        $config['db']['username'],
        $config['db']['password'],
        $config['db']['name']
    );

    // Проверка соединения
    if($connection == false) {
        echo 'Не удалось подключиться к базе данных TxpSidee 0_0 <br>';
        echo mysqli_connect_error();
        exit();
    }
?>
