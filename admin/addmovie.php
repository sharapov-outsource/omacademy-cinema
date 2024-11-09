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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
</head>
<body>
<?php
$sql = "SELECT * FROM bookingTable";
$bookingsNo = mysqli_num_rows(mysqli_query($con, $sql));
$moviesNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM movieTable"));
?>

<?php include('header.php'); ?>
<div class="admin-container">
    <?php include('sidebar.php'); ?>
    <div class="admin-section admin-section2">
        <div class="admin-section-column">

            <div class="admin-section-panel admin-section-panel2">
                <div class="admin-panel-section-header">
                    <h2>Фильмы</h2>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input placeholder="Название" type="text" name="movieTitle" required>

                    <!-- Dropdown for genres -->
                    <select name="movieGenre" required>
                        <option value="" disabled selected>Жанр</option>
                        <?php
                        $genre_query = "SELECT * FROM genres";
                        $genre_result = mysqli_query($con, $genre_query);
                        while ($row = mysqli_fetch_assoc($genre_result)) {
                            echo "<option value='" . $row['genreName'] . "'>" . $row['genreName'] . "</option>";
                        }
                        ?>
                    </select>
                    <input placeholder="Продолжительность" type="number" name="movieDuration" required />
                    <input placeholder="Дата релиза" type="date" name="movieRelDate" required />
                    <input placeholder="Режиссер" type="text" name="movieDirector" required />
                    <input placeholder="Актеры" type="text" name="movieActors" required />
                    <br>
                    <label>Добавить постер</label>
                    <input type="file" name="movieImg" accept="image/*">
                    <button type="submit" value="submit" name="submit" class="form-btn">Добавить фильм</button>

                    <?php
                    if (isset($_POST['submit'])) {
                        // Обработка загрузки файла
                        $target_dir = "img/";
                        $target_file = $target_dir . basename($_FILES["movieImg"]["name"]);
                        move_uploaded_file($_FILES["movieImg"]["tmp_name"], ROOT_PATH.$target_file);

                        $insert_query = "INSERT INTO 
                            movieTable (movieImg, movieTitle, movieGenre, movieDuration, movieRelDate, movieDirector, movieActors)
                            VALUES ('$target_file', '" . $_POST["movieTitle"] . "', '" . $_POST["movieGenre"] . "', '" . $_POST["movieDuration"] . "', '" . $_POST["movieRelDate"] . "', '" . $_POST["movieDirector"] . "', '" . $_POST["movieActors"] . "')";
                        $rs = mysqli_query($con, $insert_query);
                        if ($rs) {
                            echo "<script>alert('Успешно отправлено'); window.location.href='addmovie.php';</script>";
                        }
                    }
                    ?>
                </form>
            </div>
            <div class="admin-section-panel admin-section-panel2">
                <div class="admin-panel-section-header">
                    <h2>Фильмы</h2>
                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID фильма</th>
                        <th>Постер</th>
                        <th>Название фильма</th>
                        <th>Жанр фильма</th>
                        <th>Дата показа</th>
                        <th>Режиссер</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $select = "SELECT * FROM `movieTable`";
                    $run = mysqli_query($con, $select);
                    while ($row = mysqli_fetch_array($run)) {
                        $ID = $row['movieID'];
                        $title = $row['movieTitle'];
                        $genre = $row['movieGenre'];
                        $releasedate = $row['movieRelDate'];
                        $movieactor = $row['movieDirector'];
                        ?>
                        <tr align="center">
                            <td><?php echo $ID; ?></td>
                            <td><img src="/<?php print $row['movieImg'];?>" width="50" /></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $genre; ?></td>
                            <td><?php echo $releasedate; ?></td>
                            <td><?php echo $movieactor; ?></td>
                            <td><button value="Удалить" type="submit" class="btn btn-danger"><?php echo "<a href='deletemovie.php?id=" . $row['movieID'] . "' style='color: #ffffff'>Удалить</a>"; ?></button></td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../scripts/jquery-3.3.1.min.js"></script>
<script src="../scripts/owl.carousel.min.js"></script>
<script src="../scripts/script.js"></script>
</body>
</html>