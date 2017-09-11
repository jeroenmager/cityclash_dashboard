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

$query = 'SELECT Location.idLocation, Location.latitude, Location.longitude, Location.Name, Location.Desc FROM Location';

$submit = $database->prepare($query);
$dataArray = [];
try {
        $submit->execute();
        $data = $submit->fetchAll();
        // print_r($data);
    	if($_GET['type'] == "maps") {
        foreach ($data as $value) {
        	$dataCount = array(
				'title' => $value['Name'],
				'lat' => $value['latitude'],
				'lng' => $value['longitude'],
				'description' => $value['Desc']
			);
        	array_push($dataArray, $dataCount);
        }
    }
        elseif($_GET['type'] == "app") {
        	foreach ($data as $value) {
				$dataCount = array(
				'id' => (float)$value['idLocation'],
				'key' => (float)$value['idLocation'],
                                'color' => 'red',
				'amount' => 1,
				'coordinate' => array(
				'latitude' => (float)$value['latitude'],
				'longitude' => (float)$value['longitude']
				),
			);
			array_push($dataArray, $dataCount);
        	}
        }else {
        	echo "type not valid";
        }
    } catch (PDOException $e) {
        echo $e;
    echo "Something went wrong";
}
	
// 	$json_test = json_encode($data);
// 	print_r($json_test);
// 	echo "\n";
// 	echo "custom";
// 	echo "\n";
// 	$data = array(
// 	'id' => $data[0]['idLocation'],
// 	'key' => $data[0]['idLocation'],
// 	'amount' => 1,
// 	'coordinate' => array(
// 		'latitude' => $data[0]['latitude'],
// 		'longitude' => $data[0]['longitude']
// 	),
// 	'Desc' => $data[0]['Desc']
// );
//header('Content-Type: application/json');

$json = json_encode($dataArray);

header('Content-Type: application/json');
echo $json;
?>