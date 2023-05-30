<?php
include_once 'database.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Kassa Systeem</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
		<link rel="icon" type="image/x-icon" href="carts.png">
	</head>
	<body class="loggedin">
		<nav class="navtop" style="background-color: #272829; box-shadow: rgba(0, 0, 0, 0.65) 0px 10px 25px;">
			<div>
				<a href="home.php"><h1>Kruidenier</h1></a>
				<a href="logout.php" style="position: absolute; display: inline; right: 0; padding-right: 300px; padding-top: 15px;"><i class="fas fa-sign-out-alt"></i>Uitloggen</a>
			</div>
		</nav>
		<div>
		<center><table style="border: 1px solid orange; color: orange; margin-top: 5%; margin-right: -60%;">
            <tr>    
                <th>id</th>
                <th>naam</th>
                <th>barcode</th>
                <th>aantal</th>
                <th>prijs</th>
            </tr>
		<?php
		            $query = 'SELECT id, naam, barcode, aantal, prijs
					FROM voorraad';
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
		<div>
			<div style="margin-top: -15%; padding-left: 700px; padding-right: 700px; margin-left: -400px; list-style: none; display: -webkit-box; display: -moz-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-flex-flow: row; justify-content: space-around; height: 50px; line-height:30px;">
        		<a href="voedsel_voorraadsysteem.php" style="padding: 5px; border: 1px solid orange; text-decoration: none; background: transparent; margin: 5px; color: white; font-weight: bold; font-size: 1.5em; text-align: center; flex: 1 0 0px; height: auto;"><div style="color: orange;">Voedsel</div></a>
        		<a href="drinken_voorraadsysteem.php" style="padding: 5px; border: 1px solid orange;text-decoration: none; background: transparent; margin: 5px; color: white; font-weight: bold; font-size: 1.5em; text-align: center; flex: 1 0 0px; height: auto;"><div style="color: orange;">Drinken</div></a>
    		</div>
    		<div style="padding-left: 700px; padding-right: 700px; margin-left: -400px; list-style: none; display: -webkit-box; display: -moz-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-flex-flow: row; justify-content: space-around; height: 50px; line-height:30px;">
				<a href="objecten_voorraadsysteem.php" style="padding: 5px; border: 1px solid orange; text-decoration: none; background: transparent; margin: 5px; color: white; font-weight: bold; font-size: 1.5em; text-align: center; flex: 1 0 0px; height: auto;"><div style="color: orange;">Objecten</div></a>
				<a href="zuivel_voorraadsysteem.php" style="padding: 5px; border: 1px solid orange; text-decoration: none; background: transparent; margin: 5px; color: white; font-weight: bold; font-size: 1.5em; text-align: center; flex: 1 0 0px; height: auto;"><div style="color: orange;">Zuivel</div></a>
    		</div>
		</div>
		<div>
			<form action="upload.php" method="POST" enctype="multipart/form-data" style="margin-top: 10%;">
        		<input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
        		<input type="button" value="Voorraden Uploaden" onclick="document.getElementById('fileToUpload').click();" style="margin-left: 10%; padding: 5px; color: orange; background: transparent; border: 1px solid orange; border-radius: 5px;">
        		<input type="submit" value="Submit Form" name="submit" style="margin-left: 10%; padding: 5px; color: orange; background: transparent; border: 1px solid orange; border-radius: 5px;">
    		</form>
		</div>
	</body>
</html>