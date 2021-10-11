<?php
session_start();
$host = "127.0.0.1"; /* Host name */
$user = "root"; /* User */
$password = "password"; /* Password */
$dbname = "WearableData"; /* Database name */

$db = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
