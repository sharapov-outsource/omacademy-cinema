<?php
session_start();
include "connection.php";

if (isset($_POST['confirm'])) {
    foreach ($_SESSION['cart'] as $reservation) {
        $movieID = $reservation['movie_id'];
        $bookingDate = $reservation['date'];
        $bookingTime = $reservation['hour'];
        $bookingFName = $reservation['fName'];
        $bookingLName = $reservation['lName'];
        $bookingPNumber = $reservation['pNumber'];

        $query = "INSERT INTO bookingtable (movieID, bookingDate, bookingTime, bookingFName, bookingLName, bookingPNumber, status) 
                  VALUES ('$movieID', '$bookingDate', '$bookingTime', '$bookingFName', '$bookingLName', '$bookingPNumber', 'Новое')";
        mysqli_query($con, $query);
    }

    // Очистить корзину после успешного бронирования
    $_SESSION['cart'] = [];

    // Перенаправление с сообщением об успешном бронировании
    header("Location: cart.php?success=2");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Корзина</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <script src="_.js "></script>
</head>

<body style="background-color:#6e5a11;">
<div class="booking-panel">
    <div class="booking-panel-section booking-panel-section1">
        <h1>ВАША КОРЗИНА</h1>
    </div>
    <div class="booking-panel-section booking-panel-section2">
        <?php if (isset($_GET['success']) && $_GET['success'] == 2) : ?>
            <div style="background-color: #fff;"><h1><center>Бронирование успешно</center></h1></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['cart'])): ?>
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $reservation): ?>
                    <div class="cart-item" style="margin-bottom: 20px">
                        <h1 class="title"><?php echo $reservation['movie_title']; ?></h1>
                        <div class="movie-information">
                            <table>
                                <tr>
                                    <td>Дата</td>
                                    <td><?php echo $reservation['date']; ?></td>
                                </tr>
                                <tr>
                                    <td>Время</td>
                                    <td><?php echo $reservation['hour']; ?></td>
                                </tr>
                                <tr>
                                    <td>Имя</td>
                                    <td><?php echo $reservation['fName']; ?></td>
                                </tr>
                                <tr>
                                    <td>Фамилия</td>
                                    <td><?php echo $reservation['lName']; ?></td>
                                </tr>
                                <tr>
                                    <td>Номер телефона</td>
                                    <td><?php echo $reservation['pNumber']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <div class="booking-form-container">
            <form action="" method="POST">
                <button type="submit" name="confirm" class="form-btn">Забронировать</button>
            </form>
        </div>
        <?php else: ?>
            <p>Ваша корзина пуста.</p>
        <?php endif; ?>
    </div>
</div>

<script src="scripts/jquery-3.3.1.min.js "></script>
<script src="scripts/script.js "></script>
</body>

</html>