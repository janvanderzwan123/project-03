<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'kruidenier';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Verbinden MySQL is niet gelukt: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions, so instead, we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profiel</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
		<link rel="icon" type="image/x-icon" href="carts.png">
	</head>
	<body class="loggedin">
		<nav class="navtop" style="background-color: #272829; box-shadow: rgba(0, 0, 0, 0.65) 0px 10px 25px;">
			<div>
				<a href="home.php"><h1 class="kruidenier">Kruidenier</h1></a>
				<a href="profile.php" style="position: absolute; display: inline; right: 0; padding-right: 440px; padding-top: 15px;"><i class="fas fa-user-circle"></i>Profiel</a>
				<a href="logout.php" style="position: absolute; display: inline; right: 0; padding-right: 300px; padding-top: 15px;"><i class="fas fa-sign-out-alt"></i>Uitloggen</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profiel</h2>
			<div>
				<p>Account Details:</p>
				<table>
					<tr>
						<td style="color: #272829;">Gebruikersnaam:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td style="color: #272829;">Wachtwoord:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td style="color: #272829;">Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>