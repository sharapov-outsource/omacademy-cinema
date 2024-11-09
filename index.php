<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Дом кино</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <script src="_.js "></script>
</head>

<body>
<?php
include "connection.php";
$sql = "SELECT * FROM movieTable";
?>
<header>
    <?php include "includes/header.php"; ?>
</header>
<div id="home-section-1" class="movie-show-container">
    <h1>Сейчас в кино</h1>
    <h3>Забронируйте билет</h3>

    <div class="movies-container">

        <?php
        if ($result = mysqli_query($con, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                for ($i = 0; $i < 5; $i++) {
                    $row = mysqli_fetch_array($result);
                    echo '<div class="movie-box">';
                    echo '<img src="' . $row['movieImg'] . '" alt=" ">';
                    echo '<div class="movie-info ">';
                    echo '<h3>' . $row['movieTitle'] . '</h3>';
                    echo '<a href="booking.php?id=' . $row['movieID'] . '"><i class="fas fa-ticket-alt"></i> Забронировать</a>';
                    echo '</div>';
                    echo '</div>';
                }
                mysqli_free_result($result);
            } else {
                echo '<h4 class="no-annot">Сейчас нет доступных бронирований</h4>';
            }
        } else {
            echo "ERROR: Не удалось выполнить $sql. " . mysqli_error($con);
        }

        // Закрытие соединения
        mysqli_close($con);
        ?>
    </div>

    <a href="/schedule.php">Расписание сеансов</a>
</div>

<footer>
    <?php include "includes/footer.php"; ?>
</footer>
<script src="scripts/jquery-3.3.1.min.js "></script>
<script src="scripts/script.js "></script>
</body>
</html>