<?php
include 'database.php';
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
        <div>
		<center><table style="border: 1px solid orange; color: orange; margin-top: 5%;">
            <tr>    
                <th>id</th>
                <th>naam</th>
                <th>barcode</th>
                <th>aantal</th>
                <th>prijs</th>
            </tr>
		<?php
		            $query = 'SELECT id, naam, barcode, aantal, prijs
					FROM voorraad WHERE categorie=3';
		$result = mysqli_query($conn, $query);
		$aantal = mysqli_num_rows($result);
		$contentTable = '';
		if ($aantal > 0) {
			while ($row = mysqli_fetch_array($result)) {
				$contentTable .= "<tr>
				<td>" . $row['id'] . "</td>
				<td>" . $row['naam'] . "</td>
				<td>" . $row['barcode'] . "</td>
				<td>" . $row['aantal'] . "</td>
				<td>" . $row['prijs'] . "</td>
				</tr>";
			}
		}
		$contentTable .= "</table></center><br>";
		echo $contentTable;
		?>
		</div>
	</body>
</html>