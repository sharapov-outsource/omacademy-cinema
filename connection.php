<?php
$host = "localhost"; /* Host name */
$user = "cinema"; /* User */
$password = "cinema"; /* Password */
$dbname = "cinema2"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
