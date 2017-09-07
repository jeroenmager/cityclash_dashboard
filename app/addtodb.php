<?php 

require('assets/db/db.php');

$locNaam = $_POST['locName'];
$locLat = $_POST['locLat'];
$locLng = $_POST['locLng'];

try {
    if(isset($conn)){
        // set the PDO error mode to exception

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO Location (latitude, longitude, Name) 
        VALUES (:locLat, :locLng, :locName)");
        $stmt->bindParam(':locLat', $locLat);
        $stmt->bindParam(':locLng', $locLng);
        $stmt->bindParam(':locName', $locNaam);

        // insert a row
        $locLat = $_POST['locLat'];
        $locLng = $_POST['locLng'];
        $locNaam = $_POST['locName'];;
        $stmt->execute();

        echo "New records created successfully";
        }else{
            echo "connection not set";
        }
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
