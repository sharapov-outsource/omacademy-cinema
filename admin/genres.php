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
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Административная панель - Жанры фильмов</title>
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
                            <h2>Управление <b>жанрами фильмов</b></h2>
                        </div>
                        <div class="col-sm-4">
                            <a href='addGenre.php'><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Добавить новый жанр</button></a>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID жанра</th>
                        <th>Название жанра</th>
                        <th>Действия</th>
                    </tr>
                    <tbody>
                    <?php
                    $select = "SELECT * FROM `genres`";
                    $run = mysqli_query($con, $select);
                    while ($row = mysqli_fetch_array($run)) {
                        $genreID = $row['genreID'];
                        $genreName = $row['genreName'];
                        ?>
                        <tr align="center">
                            <td><?php echo $genreID; ?></td>
                            <td><?php echo $genreName; ?></td>
                            <td>
                                <button type="submit" class="btn btn-danger">
                                    <?php echo "<a style='color: #ffffff' href='deleteGenre.php?id=" . $row['genreID'] . "'>Удалить</a>"; ?>
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