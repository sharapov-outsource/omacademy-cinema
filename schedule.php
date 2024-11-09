<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/styles.css">
    <title>Расписание фильмов</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="_.js"></script>
</head>

<header>
    <?php include "includes/header.php"; ?>
</header>

<body>
<div class="schedule-section">
    <h1>Расписание</h1>
    <div class="schedule-dates">
        <div class="schedule-item">10 марта, 2024</div>
        <div class="schedule-item schedule-item-selected">11 марта, 2024</div>
        <div class="schedule-item">12 марта, 2024</div>
        <div class="schedule-item">13 марта, 2024</div>
        <div class="schedule-item">14 марта, 2024</div>
    </div>
    <div class="schedule-table">
        <table>
            <tr>
                <th>ФИЛЬМ</th>
                <th>ЖАНР</th>
                <th>ДЛИТЕЛЬНОСТЬ</th>
            </tr>
            <?php
            include "connection.php";
            $sql = "SELECT * FROM movieTable";
            if ($result = mysqli_query($con, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr class="fade-scroll">';
                        echo '    <td>';
                        echo '        <h2>' . $row['movieTitle'] . '</h2>';
                        echo '    </td>';
                        echo '    <td>' . $row['movieGenre'] . '</td>';
                        echo '    <td><i class="far fa-clock"></i> ' . $row['movieDuration'] . 'м</td>';
                        echo '</tr>';
                    }
                    mysqli_free_result($result);
                } else {
                    echo '<tr><td colspan="4">Нет доступных сеансов</td></tr>';
                }
            } else {
                echo "ERROR: Не удалось выполнить $sql. " . mysqli_error($con);
            }

            // Закрытие соединения
            mysqli_close($con);
            ?>
        </table>
    </div>
</div>

<footer>
    <?php include "includes/footer.php"; ?>
</footer>

<script src="scripts/jquery-3.3.1.min.js"></script>
<script src="scripts/owl.carousel.min.js"></script>
<script src="scripts/script.js"></script>
</body>

</html>