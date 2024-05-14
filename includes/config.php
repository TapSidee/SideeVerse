<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'TxpSidee';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die('Ошибка подключения к базе данных TxpSidee 0_0 ' . mysqli_connect_error());
}