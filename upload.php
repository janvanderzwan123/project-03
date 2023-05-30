<?php

include 'database.php';

// check if file was uploaded
if (isset($_FILES["fileToUpload"]["name"])) {
    
    // define target directory for uploaded file
    $target_dir = __DIR__ . "/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // check if file is a valid csv file
    if ($fileType != "csv") {
        echo "Sorry, only CSV files are allowed.";
        $uploadOk = 0;
    }

    // check if file was uploaded successfully
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";

            // open file
            $file = fopen($target_file, "r");

            // loop through rows
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                if (count($data) != 6) {
                    // Handle error: the number of fields in this line is not correct
                    continue;
                }
                list($id, $naam, $barcode, $aantal, $categorie, $prijs) = $data;
                $id = $conn->real_escape_string($id);
                $naam = $conn->real_escape_string($naam);
                $barcode = $conn->real_escape_string($barcode);
                $aantal = $conn->real_escape_string($aantal);
                $categorie = $conn->real_escape_string($categorie);
                $prijs = $conn->real_escape_string($prijs);
                // Process the data...

                // insert data into database table
                $sql = "INSERT INTO voorraad (id, naam, barcode, aantal, categorie, prijs) VALUES ('$id', '$naam', '$barcode', '$aantal', '$categorie', '$prijs')";
                if (!$conn->query($sql)) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // close file and delete uploaded file
            fclose($file);
            unlink($target_file);

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// close connection
$conn->close();

?>
