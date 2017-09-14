<?php 

// Define configuration
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "bikohond");
define("DB_NAME", "cityclash_db");

require('assets/classes/addtodb.class.php');

try {
    $database = new
    PDO("mysql:host=$dbhost;dbname=$dbname", $user, $pass);
    $database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
} catch(PDOException $e) {
    echo $e->getMessage();
    echo "Connection failed, try again later";
}

if (isset($_POST['GroupName']) && isset($_POST['GroupPassword']) && isset($_POST['GroupRole'])){
    if($_POST['GroupName'] != '' || $_POST['GroupPassword'] != '' || $_POST['GroupRole'] != ''){
        $groupName = $_POST['GroupName'];
        $groupPassword = $_POST['GroupPassword'];
        $groupRole = $_POST['GroupRole'];


        $query = 'INSERT INTO User (Role, Name, Password, Active) VALUES ($groupRole, $groupName, $groupPassword, "1";';
        $submit = $data

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
