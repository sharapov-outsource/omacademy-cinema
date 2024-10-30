<?php
include "connection.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);


// variables
$fname = $_POST['fName'];
$lname = $_POST['lName'];
$mobile = $_POST['pNumber'];
$date = $_POST['date'];
$time = $_POST['hour'];
$movieid = $_POST['movie_id'];

if ((!$_POST['submit'])) {
    die('');
}

if (isset($_POST['submit'])) {
    print $qry = "INSERT INTO bookingtable(`movieID`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `status`) VALUES ('$movieid','$date','$time','$fname','$lname','$mobile','Новое')";
    $result = mysqli_query($con, $qry);
}

header('Location: /booking.php?id=' . $movieid.'&success=1');
exit;