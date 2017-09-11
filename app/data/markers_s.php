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

$query = 'SELECT Location.idLocation, Location.latitude, location.longitude, Location.Name, location.Desc FROM Location';

$submit = $database->prepare($query);

try {
        $submit->execute();
        $data = $submit->fetchAll();
        // print_r($data);
    } catch (PDOException $e) {
        echo $e;
    echo "Something went wrong";
}
if($_GET['type'] == "map") {
	$data = array(
		'title' => $data[1]['Name'],
		'lat' => $data[1]['latitude'],
		'lng' => $data[1]['longitude'],
		'description' => $data[1]['Desc']
);
} else {
	$json_test = json_encode($data);
	print_r($json_test);
	echo "\n";
	echo "custom";
	echo "\n";
	$data = array(
	'id' => $data[0]['idLocation'],
	'key' => $data[0]['idLocation'],
	'amount' => 1,
	'coordinate' => array(
		'latitude' => $data[1]['latitude'],
		'longitude' => $data[1]['longitude']
	),
	'Desc' => $data[1]['Desc']
);
}
header('Content-Type: application/json');

$json = json_encode($data);

print_r($json);
?>