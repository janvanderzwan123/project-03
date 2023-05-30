<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
		<link rel="icon" type="image/x-icon" href="carts.png">
	</head>
	<body class="loggedin">
		<nav class="navtop" style="background-color: #272829; box-shadow: rgba(0, 0, 0, 0.65) 0px 10px 25px;">
			<div>
				<h1>Kruidenier</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profiel</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Uitloggen</a>
			</div>
		</nav>
		<div class="content">
			<h2>Keuze menu</h2>
			<p>Welkom terug, <?=$_SESSION['name']?>!</p>
		</div>
		<div class="buttons">
			<center><a href="kassasysteem.php"><button style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; border-radius: 15px; font-size: 36px; width: 600px; height: 75px; background-color: orange; box-shadow: rgba(0, 0, 0, 0.65) 0px 10px 25px;">kassasysteem</button></a></center><br>
			<center><a href="admin_check.php"><button action="admin_check.php" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; border-radius: 15px; font-size: 36px; width: 600px; height: 75px; background-color: orange; box-shadow: rgba(0, 0, 0, 0.65) 0px 10px 25px;">voorraadsysteem</button></a></center><br>
		</div>
	</body>
</html>

