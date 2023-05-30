<?php 
include 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kassa Systeem</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	<link rel="icon" type="image/x-icon" href="carts.png">
    <script src="product_zoeken.js"></script>
</head>
<body class="loggedin">
	<nav class="navtop" style="background-color: #272829; box-shadow: rgba(0, 0, 0, 0.65) 0px 10px 25px;">
		<div>
			<a href="home.php"><h1>Kruidenier</h1></a>
			<a href="profile.php" style="position: absolute; display: inline; right: 0; padding-right: 440px; padding-top: 15px;"><i class="fas fa-user-circle"></i>Profiel</a>
			<a href="logout.php" style="position: absolute; display: inline; right: 0; padding-right: 300px; padding-top: 15px;"><i class="fas fa-sign-out-alt"></i>Uitloggen</a>
		</div>
		<form action="#" method="POST" style="margin-top: 140px;">
			<center><label for="barcode" style="font-size: 36px; text-align: center; color: orange;">Voer hier de barcode in<br> of zoek op productnaam</label></center>
			<center><input type="text" name="barcode" id="barcode" style="color: orange; box-shadow: rgba(0, 0, 0, 0.65) 0px 10px 25px; background-color: #272829; margin-top: 30px; width: 380px; border: 5px solid orange; padding: 15px; border-radius: 15px;"></center>
		</form>
			<?php
include("developers.php");
?>
<html>
<body>
    <?php echo $deleteMsg??''; ?>
    <div style="display: flex; flex-direction: column;">
        <table style="border: 1px solid orange; margin-top: -20%; margin-left: -15%; width: 40%;">
            <th style="color: orange;">id</th>
            <th style="color: orange;">naam</th>
            <th style="color: orange;">barcode</th>
            <th style="color: orange;">aantal</th>
            <th style="color: orange;">prijs</th>
    </thead>
    <tbody>

<?php
$deleteMsg = '';
if (isset($_POST['delete'])) {
    $delete = $_POST['delete'];
    $delete_query = "DELETE FROM kassa_2 WHERE id=$delete";
    if (mysqli_query($conn, $delete_query)) {
        $deleteMsg = 'Product is verwijderd.';
    } else {
        $deleteMsg = 'Er is iets fout gegaan.';
    }
}

if (isset($_POST['barcode'])) {
    $search = mysqli_real_escape_string($conn, $_POST['barcode']);
    $query = "SELECT id, naam, barcode, prijs FROM voorraad WHERE naam LIKE '%$search%' OR barcode='$search'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $naam = $row['naam'];
        $barcode = $row['barcode'];
        $prijs = $row['prijs'];
        $check_query = "SELECT * FROM kassa_2 WHERE barcode='$barcode'";
        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $kassa_row = mysqli_fetch_assoc($check_result);
            $kassa_aantal = $kassa_row['aantal'];
            $update_query = "UPDATE kassa_2 SET aantal=$kassa_aantal+0 WHERE barcode='$barcode'";
            mysqli_query($conn, $update_query);
        } else {
            $insert_query = "INSERT INTO kassa_2 (id, naam, barcode, aantal, prijs) VALUES ('$id', '$naam', '$barcode', '?', '$prijs')";
            mysqli_query($conn, $insert_query);
        }
        $update_voorraad_query = "UPDATE voorraad SET aantal=aantal-1 WHERE barcode='$barcode'";
        mysqli_query($conn, $update_voorraad_query);
        $update_kassa_2_query = "UPDATE kassa_2 SET aantal=aantal+1 WHERE barcode='$barcode'";
        mysqli_query($conn, $update_kassa_2_query);
    } else {
        echo "Product niet gevonden.";
    }
}

if (isset($_POST['new_customer'])) {
    $copy_query = "INSERT INTO rapport_2 (id, naam, barcode, aantal, prijs) SELECT id, naam, barcode, aantal, prijs FROM kassa_2";
    if (mysqli_query($conn, $copy_query)) {
        $empty_query = "DELETE FROM kassa_2";
        if (mysqli_query($conn, $empty_query)) {
            $_SESSION["total"] = 0;
        } else {
            echo "Er is iets fout gegaan.";
        }
    } else {
        echo "Er is iets fout gegaan.";
    }
}


//maakt de kassa_2 tabel
$table = 'SELECT id, naam, barcode, aantal, prijs FROM kassa_2';
$result = mysqli_query($conn, $table);
while ($a_row = mysqli_fetch_assoc($result)) {
    echo "<tr style='border: 1px solid orange;'>";
    foreach ($a_row as $a_field => $a_value) {
        if ($a_field == "prijs") {
            echo "<td style='color: orange;'>€" . $a_value . "</td>";
        } else {
            echo "<td style='color: orange;'>" . $a_value . "</td>";
        }
    }
    echo "</tr>";
}
?>


    <tr>
    </tbody>
     </table>
            <!-- maakt "nieuwe klant" knop -->
        <br>
        <br>
        <form action="#" method="POST" style="width: 10%;">
            <input type="submit" name="new_customer" value="Nieuwe Klant" style="border: 1px solid orange; border-radius: 5px; padding: 5px; padding-right: 5px; text-align: center; background-color: transparent; color: orange;">
        </form>
            
        </div>
            <!-- maakt "Rapport Maken" knop -->
        <form action="rapport_kassa_2.php" method="POST">					
			<center><button type="submit" id="Exporteren" name="Exporteren" value="Exporteren naar excel" style="border: 1px solid orange; border-radius: 5px; padding: 5px; padding-left: 25px; padding-right: 25px; color: orange; background: transparent;">Rapport Maken</button></center>
		</form>
    </body>
</html>