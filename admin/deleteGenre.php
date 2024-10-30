<?php
include "config.php";

// Проверка вошел ли пользователь в систему
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

// Выйти из системы
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}

$con = mysqli_connect($host, $user, $password, $dbname);

if (isset($_GET['id'])) {
    $genreID = $_GET['id'];

    $sql = "DELETE FROM genres WHERE genreID = $genreID";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Жанр успешно удален');
              window.location.href='genres.php';</script>";
    } else {
        echo "<script>alert('Ошибка при удалении жанра');
              window.location.href='genres.php';</script>";
    }
} else {
    echo "Неверный запрос";
}
?>