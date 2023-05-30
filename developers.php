<?php
include("database.php");
$db= $conn;
$tableName="voorraad";
$columns= ['id', 'naam','barcode','aantal','prijs'];
$fetchData = fetch_data($db, $tableName, $columns);
function fetch_data($db, $tableName, $columns){
 if (empty($db)) {
  $msg= "Database verbinding mislukt";
 } else if (empty($columns) || !is_array($columns)) {
  $msg="define";
 } else if (empty($tableName)) {
   $msg= "Table is leeg";
} else {
$columnName = implode(", ", $columns);
$query = "SELECT ".$columnName." FROM $tableName"." ORDER BY id DESC";
$result = $db->query($query);
if ($result== true) { 
 if ($result->num_rows > 0) {
    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $msg= $row;
 } else {
    $msg= "Geen data gevonden"; 
 }
} else {
  $msg= mysqli_error($db);
}
}
return $msg;
}
?>