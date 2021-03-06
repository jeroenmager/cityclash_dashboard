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
$query = 'SELECT Question.idQuestion, Question.Text, Question.Photo, Question.Video, Question.Active, Question.Location_idLocation, Question.type FROM Question';
$submit = $database->prepare($query);
$dataArray = [];
try {
	$submit->execute();
	$data = $submit->fetchAll();
	foreach ($data as $value) {
		$dataCount = array(
			'id' => (float)$value['idQuestion'],
			'text' => $value['Text'],
			'photo' => $value['Photo'],
			'video' => $value['Video'],
			'Active' => $value['Active'],
			'Location_idLocation' => (float)$value['Location_idLocation'],
			'type' => $value['type']
	);
    array_push($dataArray, $dataCount);
	}
} catch (PDOException $e) {
	echo $e->getMessage();
	echo "Connection to database failed";
}
$json = json_encode($dataArray);
header('Content-Type: application/json');
echo $json;
