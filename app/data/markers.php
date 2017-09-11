<?php
//assign variables for connection
$db = parse_ini_file("database.ini");

$dbhost = $db['host'];
$dbname = $db['name'];
$user = $db['user'];
$pass = $db['pass'];


//connect to database and check if connection succeeded yes or no
try {
	$database = new
	PDO("mysql:host=$dbhost;dbname=$dbname", $user, $pass);
	$database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
} catch(PDOException $e) {
	echo $e->getMessage();
	echo "Connection failed, try again later";
}

$jsonData = $database->query('SELECT Location.idLocation, Location.latitude, location.longitude, Location.Name, location.Desc FROM Location');


$json = array(
	'id' => $jsonData[0]['idLocation'],
	'key' => $jsonData[0]['idLocation'],
	'amount' => 1,
	'coordinate' => array(
		'latitude' => $jsonData[0]['latitude'],
		'longitude' => $jsonData[0]['longitude']
	)
);
}

header('Content-Type: application/json');

json_encode($json);

