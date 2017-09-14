<?php
//assign variables for connection
$db = parse_ini_file("data/database.ini");

$dbhost = $db['host'];
$dbname = $db['name'];
$user = $db['user'];
$pass = $db['pass'];

$groupName = 0;
$groupPassword = 0;
$groupRole = 0;

if (isset($_POST['GroupName']) && isset($_POST['GroupPassword']) && isset($_POST['GroupRole'])){
    if($_POST['GroupName'] != '' || $_POST['GroupPassword'] != '' || $_POST['GroupRole'] != ''){
        $groupName = $_POST['GroupName'];
        $groupPassword = $_POST['GroupPassword'];
        $groupRole = $_POST['GroupRole'];

    }else{
        echo 'één of meerdere velden zijn leeg';
    }
}else{
    echo 'Er is iets fout gegaan';
}

try {
    $database = new
    PDO("mysql:host=$dbhost;dbname=$dbname", $user, $pass);
    $database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );

    $query = "INSERT INTO User (Role, Name, Password) VALUES ('" .$groupRole . "', '" . $groupName . "', '" . $groupPassword . "');";
    $submit = $database->prepare($query);
    $submit->execute();
    echo "User toegevoegd in database";
    header("groups.html");
	die();
} catch(PDOException $e) {
    echo $e->getMessage();
    echo "Connection failed, try again later";
}
?>