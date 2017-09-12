<?php 

// Define configuration
define("DB_HOST", "localhost");
define("DB_USER", "cityclash");
define("DB_PASS", "cityclash123");
define("DB_NAME", "cityclash_db");

require('assets/classes/addtodb.class.php');

if (isset($_POST['locName']) && isset($_POST['locLat']) && isset($_POST['locLng'])){
    if($_POST['locName'] != '' || $_POST['locLat'] != '' || $_POST['locLng'] != ''){
        $locNaam = $_POST['locName'];
        $locLat = $_POST['locLat'];
        $locLng = $_POST['locLng'];


        $new_locatie = new Database();
        $new_locatie->set_location($locNaam, $locLat, $locLng);
        $new_locatie->db_execute();
    }else{
        echo 'één of meerdere velden zijn leeg';
    }
}else{
    echo 'Er is iets fout gegaan';
}

//try {
//    if(isset($conn)){
//        // set the PDO error mode to exception
//
//        // prepare sql and bind parameters
//        $stmt = $conn->prepare("INSERT INTO Location (latitude, longitude, Name) 
//        VALUES (:locLat, :locLng, :locName)");
//        $stmt->bindParam(':locLat', $locLat);
//        $stmt->bindParam(':locLng', $locLng);
//        $stmt->bindParam(':locName', $locNaam);
//
//        // insert a row
//        $locLat = $_POST['locLat'];
//        $locLng = $_POST['locLng'];
//        $locNaam = $_POST['locName'];;
//        $stmt->execute();
//
//        echo "New records created successfully";
//        }else{
//            echo "connection not set";
//        }
//    }
//catch(PDOException $e)
//    {
//    echo "Error: " . $e->getMessage();
//    }
//$conn = null;
