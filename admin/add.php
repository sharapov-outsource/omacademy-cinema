<?php
include "config.php";

// Проверка авторизации пользователя
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

// Выход из системы
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавление записи</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<?php
$link = mysqli_connect("localhost", "root", "", "cinema_db");
$sql = "SELECT * FROM bookingTable";
$bookingsNo = mysqli_num_rows(mysqli_query($link, $sql));
$messagesNo = mysqli_num_rows(mysqli_query($link, "SELECT * FROM feedbackTable"));
$moviesNo = mysqli_num_rows(mysqli_query($link, "SELECT * FROM movieTable"));
?>

<?php include('header.php'); ?>

<div class="admin-container">

    <?php include('sidebar.php'); ?>
    <div class="admin-section admin-section2">
        <div class="admin-section-column">

            <div class="admin-section-panel admin-section-panel2">
                <div class="admin-panel-section-header">
                    <h2>ДОБАВИТЬ ЗАПИСЬ</h2>
                    <i class="fas fa-film" style="background-color: #4547cf"></i>
                </div>
                <div class="booking-form-container">
                    <form action="spot.php" method="POST">

                        <select name="theatre" required>
                            <option value="" disabled selected>ТЕАТР</option>
                            <option value="main-hall">Основной зал</option>
                            <option value="vip-hall">VIP зал</option>
                            <option value="private-hall">Приватный зал</option>
                        </select>

                        <select name="type" required>
                            <option value="" disabled selected>ТИП</option>
                            <option value="3d">3D</option>
                            <option value="2d">2D</option>
                            <option value="imax">IMAX</option>
                            <option value="7d">7D</option>
                        </select>

                        <select name="date" required>
                            <option value="" disabled selected>ДАТА</option>
                            <option value="12-3">12 марта 2019</option>
                            <option value="13-3">13 марта 2019</option>
                            <option value="14-3">14 марта 2019</option>
                            <option value="15-3">15 марта 2019</option>
                            <option value="16-3">16 марта 2019</option>
                        </select>

                        <select name="hour" required>
                            <option value="" disabled selected>ВРЕМЯ</option>
                            <option value="09-00">09:00</option>
                            <option value="12-00">12:00</option>
                            <option value="15-00">15:00</option>
                            <option value="18-00">18:00</option>
                            <option value="21-00">21:00</option>
                            <option value="24-00">00:00</option>
                        </select>

                        <input placeholder="Имя" type="text" name="fName" required>

                        <input placeholder="Фамилия" type="text" name="lName">

                        <input placeholder="Номер телефона" type="text" name="pNumber" required>
                        <input placeholder="Электронная почта" type="email" name="email" required>
                        <input placeholder="ID фильма" type="text" name="movie_id">

                        <input placeholder="Сумма" type="text" name="cash" required>

                        <button type="submit" value="submit" name="submit" class="form-btn">ДОБАВИТЬ ЗАПИСЬ</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="../scripts/jquery-3.3.1.min.js "></script>
<script src="../scripts/owl.carousel.min.js "></script>
<script src="../scripts/script.js "></script>
</body>

</html>