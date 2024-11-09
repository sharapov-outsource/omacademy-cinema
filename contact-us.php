<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Свяжитесь с нами</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <script src="_.js "></script>
</head>

<body>
<?php
include "connection.php";
?>
<header>
    <?php include "includes/header.php"; ?>
</header>
<div class="contact-us-container">
    <div class="contact-us-section contact-us-section1">
        <h1>Контакты</h1>
        <p>Не стесняйтесь связаться с нами</p>
        <form action="" method="POST">
            <input placeholder="Имя" name="fName" required><br>
            <input placeholder="Фамилия" name="lName"><br>
            <input placeholder="Электронная почта" name="eMail" required><br>
            <textarea placeholder="Введите ваше сообщение!" name="feedback" rows="10" cols="30" required></textarea><br>
            <button type="submit" name="submit" value="submit">Отправить сообщение</button>
            <?php
            if (isset($_POST['submit'])) {
                $insert_query = "INSERT INTO 
                        feedbackTable ( senderfName,
                                        senderlName,
                                        sendereMail,
                                        senderfeedback)
                        VALUES (        '" . $_POST["fName"] . "',
                                        '" . $_POST["lName"] . "',
                                        '" . $_POST["eMail"] . "',
                                        '" . $_POST["feedback"] . "')";
                $add = mysqli_query($con, $insert_query);

                if ($add) {
                    echo "<script>alert('Успешно отправлено');</script>";
                }
            }
            ?>
        </form>

    </div>
    <div class="contact-us-section contact-us-section2">
        <h1>Контакты</h1>
        <h3>Телефоны</h3>
        <p><a href="tel:88007564783">8(800)7564783</a></p>
        <h3>Адрес</h3>
        <p>ул Комарова 13</p>
        <h3>Электронная почта</h3>
        <p><a href="mailto:cinema@example.com">cinema@example.com</a></p>
    </div>
</div>
<div>
    <div class="gmap_canvas"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2289.0723450888167!2d73.29309251275745!3d54.98936555041964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43ab01a145eaf1bd%3A0xdca78e0b2f0ae576!2sKomarova%2C%2013%2C%20Omsk%2C%20Omskaya%20oblast&#39;%2C%20644112!5e0!3m2!1sen!2sru!4v1731147535656!5m2!1sen!2sru" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
<footer>
    <?php include "includes/footer.php"; ?>
</footer>
<script src="scripts/jquery-3.3.1.min.js "></script>
<script src="scripts/owl.carousel.min.js "></script>
<script src="scripts/script.js "></script>
</body>

</html>