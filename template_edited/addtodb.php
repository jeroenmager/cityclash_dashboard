<?php 

require('assets/db/db.php');

// Location
$locNaam = $_POST['locName'];
$locLat = $_POST['locLat'];
$locLng = $_POST['locLng'];

//Groups
$GroupRole = $_POST['GroupRole'];
$GroupName = $_POST['GroupName'];
$GroupPassword = $_POST['GroupPassword'];


try {
    if(isset($conn)){
        // set the PDO error mode to exception

        // prepare sql and bind parameters
        
        // Location add to db
        $stmt = $conn->prepare("INSERT INTO Location (latitude, longitude, Name) 
        VALUES (:locLat, :locLng, :locName)");
        $stmt->bindParam(':locLat', $locLat);
        $stmt->bindParam(':locLng', $locLng);
        $stmt->bindParam(':locName', $locNaam);
        
        // Group add to db
        $stmt = $conn->prepare("INSERT INTO User (Role, Name, Password) 
        VALUES (:GroupRole, :GroupName, :GroupPassword)");
        $stmt->bindParam(':GroupRole', $GroupRole);
        $stmt->bindParam(':GroupName', $GroupName);
        $stmt->bindParam(':GroupPassword', $GroupPassword);

        // insert a row
        //Location row
        $locLat = $_POST['locLat'];
        $locLng = $_POST['locLng'];
        $locNaam = $_POST['locName'];;
        
        //Group row
        $GroupRole = $_POST['GroupRole'];
        $GroupName = $_POST['GroupName'];
        $GroupPassword = $_POST['GroupPassword'];
        
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
