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

if (isset($_POST['add_genre'])) {
    $genreName = $_POST['genreName'];

    $sql = "INSERT INTO genres (genreName) VALUES ('$genreName')";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Жанр успешно добавлен');
              window.location.href='genres.php';</script>";
    } else {
        echo "<script>alert('Ошибка при добавлении жанра');
              window.location.href='genres.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Административная панель - Добавить жанр</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
</head>

<body>

<?php include('header.php'); ?>

<div class="admin-container">
    <?php include('sidebar.php'); ?>
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Добавить <b>новый жанр фильма</b></h2>
                        </div>
                    </div>
                </div>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="genreName">Название жанра</label>
                        <input type="text" class="form-control" id="genreName" name="genreName" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_genre">Добавить жанр</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="../scripts/jquery-3.3.1.min.js "></script>
<script src="../scripts/owl.carousel.min.js "></script>
<script src="../scripts/script.js "></script>
</body>

</html>