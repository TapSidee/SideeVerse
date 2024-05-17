<?php
    // Подключение конфигурационного файла
    require 'config.php';

    // Получение данных из формы
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $senderName = mysqli_real_escape_string($connection, $_POST["sender_name"]);
        $senderEmail = mysqli_real_escape_string($connection, $_POST["sender_email"]);
        $subject = mysqli_real_escape_string($connection, $_POST["subject"]);
        $messageText = mysqli_real_escape_string($connection, $_POST["message_text"]);

        // SQL-запрос для вставки данных в таблицу feedback
        $sql = "INSERT INTO feedback (sender_name, sender_email, subject, message_text)
                VALUES ('$senderName', '$senderEmail', '$subject', '$messageText')";

        if (mysqli_query($connection, $sql)) {
            header("Location: ../feedback.php?status=success");
        } else {
            header("Location: ../feedback.php?status=error");
        }
        exit();
    }
?>