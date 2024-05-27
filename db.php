<?php

$servername = "fdb34.awardspace.net";
$username = "3931224_glabaatuve";
$password = "loltop123123123";
$dbname = "3931224_glabaatuve";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
