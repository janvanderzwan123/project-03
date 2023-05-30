<?php
$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "kruidenier";
 $conn = new mysqli($hostName, $userName, $password, $databaseName);

if ($conn->connect_error) {
  die("Verbinding mislukt: " . $conn->connect_error);
}
?>