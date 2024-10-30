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
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Административная панель</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                            <h2>Детали <b>бронирования</b></h2>
                        </div>
                        <!--<div class="col-sm-4">
                            <a href='add.php'><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Добавить Новый</button></a>
                        </div>-->
                    </div>
                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID бронирования</th>
                        <th>ID фильма</th>
                        <th>Имя</th>
                        <th>Номер телефона</th>
                        <th>Email</th>
                        <th>Дата</th>
                        <th>Театр и Тип</th>
                        <th>Время</th>
                        <th>ID заказа</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                    <tbody>
                    <?php
                    $con = mysqli_connect($host, $user, $password, $dbname);
                    $select = "SELECT * FROM `bookingtable`";
                    $run = mysqli_query($con, $select);
                    while ($row = mysqli_fetch_array($run)) {
                        $bookingid = $row['bookingID'];
                        $movieID = $row['movieID'];
                        $bookingFName = $row['bookingFName'];
                        $bookingLName = $row['bookingLName'];
                        $mobile = $row['bookingPNumber'];
                        $email = $row['bookingEmail'];
                        $date = $row['bookingDate'];
                        $theatre = $row['bookingTheatre'];
                        $type = $row['bookingType'];
                        $time = $row['bookingTime'];
                        $ORDERID = $row['ORDERID'];
                        $amount = $row['amount'];
                        $status = $row['status'];
                        ?>
                        <tr align="center">
                            <td><?php echo $bookingid; ?></td>
                            <td><?php echo $movieID; ?></td>
                            <td><?php echo $bookingFName . ' ' . $bookingLName; ?></td>
                            <td><?php echo $mobile; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $theatre . ' ' . $type; ?></td>
                            <td><?php echo $time; ?></td>
                            <td><?php echo $ORDERID; ?></td>
                            <td><?php echo $amount; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <button type="submit" type="button" class="btn btn-outline-danger">
                                    <?php echo "<a href='deleteBooking.php?id=" . $row['bookingID'] . "'>удалить</a>"; ?>
                                </button>
                                <button name="update" type="submit" onclick="" type="button" class="btn btn-outline-warning">
                                    <?php echo "<a href='editBooking.php?id=" . $row['bookingID'] . "'>обновить</a>"; ?>
                                </button>
                                <button name="confirm" type="button" class="btn btn-outline-success">
                                    <?php echo "<a href='updateStatus.php?id=" . $row['bookingID'] . "&status=Подтверждено'>подтвердить</a>"; ?>
                                </button>
                                <button name="cancel" type="button" class="btn btn-outline-secondary">
                                    <?php echo "<a href='updateStatus.php?id=" . $row['bookingID'] . "&status=Отменено'>отменить</a>"; ?>
                                </button>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../scripts/jquery-3.3.1.min.js "></script>
<script src="../scripts/owl.carousel.min.js "></script>
<script src="../scripts/script.js "></script>
</body>

</html>