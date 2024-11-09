<!DOCTYPE html>
<html lang="ru">
<?php
session_start(); // Начинаем сессию
$id = $_GET['id'];

// условия
if (!$_GET['id']) {
    echo "<script>alert('Вы не должны попадать сюда напрямую');window.location.href='index.php';</script>";
}
include "connection.php";

if (isset($_POST['submit'])) {
    $movieQuery = "SELECT * FROM movieTable WHERE movieID = $id";
    $movieImageById = mysqli_query($con, $movieQuery);
    $row = mysqli_fetch_array($movieImageById);

    $reservation = [
        'date' => $_POST['date'],
        'hour' => $_POST['hour'],
        'fName' => $_POST['fName'],
        'lName' => $_POST['lName'],
        'pNumber' => $_POST['pNumber'],
        'movie_id' => $_POST['movie_id'],
        'movie_title' => $row['movieTitle']
    ];

    // Добавить бронирование в сессию
    $_SESSION['cart'][] = $reservation;

    // Перенаправление с сообщением об успешной записи
    header("Location: cart.php?id=$id&success=1");
    exit();
}

$movieQuery = "SELECT * FROM movieTable WHERE movieID = $id";
$movieImageById = mysqli_query($con, $movieQuery);
$row = mysqli_fetch_array($movieImageById);

// Calculate the dates starting from today + 5 days
$start_date = new DateTime();
$start_date->modify('+5 day');
$dates = [];
for ($i = 0; $i < 5; $i++) {
    $dates[] = clone $start_date;
    $start_date->modify('+1 day');
}
ini_set('display_errors', 1);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Забронировать <?php echo $row['movieTitle']; ?> сейчас</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <script src="_.js "></script>
</head>

<body style="background-color:#6e5a11;">
<div class="booking-panel">
    <div class="booking-panel-section booking-panel-section1">
        <h1>ЗАБРОНИРОВАТЬ БИЛЕТ</h1>
    </div>
    <div class="booking-panel-section booking-panel-section2">
    </div>
    <div class="booking-panel-section booking-panel-section3">
        <div class="movie-box">
            <?php
            echo '<img src="' . $row['movieImg'] . '" alt="">';
            ?>
        </div>
    </div>
    <div class="booking-panel-section booking-panel-section4">
        <?php if(isset($_GET['success']) && $_GET['success'] == 1) : ?>
            <div style="background-color: #fff;"><h1><center>Добавлено в корзину</center></h1></div>
        <?php endif; ?>
        <div class="title"><?php echo $row['movieTitle']; ?></div>
        <div class="movie-information">
            <table>
                <tr>
                    <td>ЖАНР</td>
                    <td><?php echo $row['movieGenre']; ?></td>
                </tr>
                <tr>
                    <td>ДЛИТЕЛЬНОСТЬ</td>
                    <td><?php echo $row['movieDuration']; ?></td>
                </tr>
                <tr>
                    <td>ДАТА ВЫХОДА</td>
                    <td><?php echo $row['movieRelDate']; ?></td>
                </tr>
                <tr>
                    <td>РЕЖИССЕР</td>
                    <td><?php echo $row['movieDirector']; ?></td>
                </tr>
                <tr>
                    <td>АКТЕРЫ</td>
                    <td><?php echo $row['movieActors']; ?></td>
                </tr>
            </table>
        </div>
        <div class="booking-form-container">
            <form action="" method="POST">
                <select name="date" required>
                    <option value="" disabled selected>ДАТА</option>
                    <?php
                    foreach ($dates as $date) {
                        $machine_readable_date = $date->format('Y-m-d');
                        $human_readable_date = $date->format('d F Y');
                        echo "<option value='$machine_readable_date'>$human_readable_date</option>";
                    }
                    ?>
                </select>
                <select name="hour" required>
                    <option value="" disabled selected>ВРЕМЯ</option>
                    <?php
                    for ($hour = 9; $hour < 24; $hour++) {
                        $time = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
                        echo "<option value='$time'>$time</option>";
                    }
                    ?>
                </select>
                <input placeholder="Имя" type="text" name="fName" required>
                <input placeholder="Фамилия" type="text" name="lName">
                <input placeholder="Номер телефона" type="text" name="pNumber" required>
                <input type="hidden" name="movie_id" value="<?php echo $id; ?>">
                <button type="submit" value="save" name="submit" class="form-btn">В корзину</button>
            </form>
        </div>
    </div>
</div>

<script src="scripts/jquery-3.3.1.min.js "></script>
<script src="scripts/script.js "></script>
</body>

</html>