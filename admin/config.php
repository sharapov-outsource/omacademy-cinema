<?php
session_start();
$host = "localhost"; /* Host name */
$user = "cinema"; /* User */
$password = "cinema"; /* Password */
$dbname = "cinema2"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

$currentDir = realpath(__DIR__.'/../').'/';

define('ROOT_PATH', $currentDir);