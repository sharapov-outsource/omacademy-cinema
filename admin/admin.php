<?php
session_start();
include "config.php";

// Проверка вошел ли пользователь в систему
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
    exit;
}

// Fetch counts for dashboard stats
$sql = "SELECT * FROM bookingtable";
$bookingsNo = mysqli_num_rows(mysqli_query($con, $sql));
$moviesNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM movietable"));
$userNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users"));

// Handle the POST request to update booking status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $bookingID = intval($_POST['bookingID']);
    $newStatus = $_POST['status'];
    $updateQuery = "UPDATE bookingtable SET status = '$newStatus' WHERE bookingID = $bookingID";
    mysqli_query($con, $updateQuery);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Получение данных для отображения бронирований
$query = "
    SELECT 
        b.bookingID,
        m.movieTitle,
        b.bookingFName,
        b.bookingLName,
        b.bookingPNumber,
        b.bookingDate,
        b.bookingTime,
        b.status
    FROM 
        bookingtable AS b
    JOIN 
        movietable AS m ON b.movieID = m.movieID
";
$run = mysqli_query($con, $query);
$bookings = [];
while ($row = mysqli_fetch_array($run)) {
    $bookings[] = $row;
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
</head>
<body>

<?php include('header.php'); ?>

<div class="admin-container">
    <?php include('sidebar.php'); ?>
    <div class="admin-section admin-section2">
        <div class="admin-section-column">
            <div class="admin-section-panel admin-section-panel1">
                <div class="admin-panel-section-header">
                    <h2>Недавние бронирования</h2>
                </div>
                <div class="admin-panel-section-content">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID Бронирования</th>
                            <th>Название фильма</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Номер телефона</th>
                            <th>Дата/Время</th>
                            <th>Статус</th>
                            <th>Обновить статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bookings as $row): ?>
                            <tr align="center">
                                <td><?php echo $row['bookingID']; ?></td>
                                <td><?php echo $row['movieTitle']; ?></td>
                                <td><?php echo $row['bookingFName']; ?></td>
                                <td><?php echo $row['bookingLName']; ?></td>
                                <td><?php echo $row['bookingPNumber']; ?></td>
                                <td><?php echo $row['bookingDate']; ?>/<?php echo $row['bookingTime']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="bookingID" value="<?php echo $row['bookingID']; ?>">
                                        <select name="status" required>
                                            <option value="Новое" <?php if ($row['status'] == 'Новое') echo 'selected'; ?>>Новое</option>
                                            <option value="Подтверждено" <?php if ($row['status'] == 'Подтверждено') echo 'selected'; ?>>Подтверждено</option>
                                            <option value="Отменено" <?php if ($row['status'] == 'Отменено') echo 'selected'; ?>>Отменено</option>
                                        </select>
                                        <button type="submit" name="update_status" class="btn btn-primary btn-sm">Обновить</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../scripts/jquery-3.3.1.min.js"></script>
<script src="../scripts/owl.carousel.min.js"></script>
<script src="../scripts/script.js"></script>
</body>
</html>