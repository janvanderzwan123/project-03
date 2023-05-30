<?php 

include_once 'database.php'; 

// data ophalen van database
$query = $conn->query("SELECT * FROM rapport_1");

if($query->num_rows > 0){
    $filename = "rapport_kassa_1_" . date('Y-m-d') . ".csv";

    $f = fopen('php://memory', 'w');

    // kolom headers maken
    $fields = array('id', 'naam', 'barcode', 'aantal', 'prijs');
    fputcsv($f, $fields);
 
    // data neerzetten
    while($row = $query->fetch_assoc()){
        $lineData = array($row['id'], $row['naam'], $row['barcode'], $row['aantal'], $row['prijs']);
        fputcsv($f, $lineData);
    } 

    // data aan het begin van het bestand zetten 
    fseek($f, 0); 
  
    // download bestand aanmaken
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 

    fpassthru($f); 

    //database table leegmaken
    $tableempty = "TRUNCATE TABLE rapport_1";
    if (!mysqli_query($conn, $tableempty)) {
        echo "er is iets fout gegaan";
    }
} 
exit;

?>

