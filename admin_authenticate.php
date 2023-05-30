<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'kruidenier';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if (!isset($_POST['username'], $_POST['password'])) {
    exit('Gebruikersnaam en wachtwoord allebei invullen alstublieft!');
}
if ($_POST['username'] === 'beheerder' && $_POST['password'] === 'admin') {
    session_regenerate_id();
    $_SESSION['loggedin'] = true;
    $_SESSION['name'] = 'beheerder';
    header('Location: voorraadsysteem.php');
} else {
    echo 'U heeft geen bevoegdheid om het voorraadsysteem te betreden!';
}
mysqli_close($con);
?>