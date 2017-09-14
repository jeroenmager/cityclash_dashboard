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

$query = 'SELECT Question.idQuestion, Question.Text, Question.Photo, Question.Video, Question.Active, Question.Location_idLocation, Question.type, Question.answer1, Question.answer2, Question.answer3, Question.answer4 FROM Question';

$submit = $database->prepare($query);
$dataArray = [];
try {
	$submit->execute();
	$data = $submit->fetchAll();
//	 print_r($data);
	if($_GET['type'] == "maps") {
	foreach ($data as $value) {
	$dataCount = array(
		'id' => (float)$value['idQuestion'],
		'titel' => $value['Titel'],
		'text' => $value['Text'],
		'photo' => base64_encode($value['Photo']),
		'video' => $value['Video'],
		'Active' => $value['Active'],
		'Location_idLocation' => (float)$value['Location_idLocation'],
		'answer1' => $value['answer1'],
		'answer2' => $value['answer2'],
		'answer3' => $value['answer3'],
		'answer4' => $value['answer4'],
		'type' => $value['type']
	);
    array_push($dataArray, $dataCount);
    }
}
elseif($_GET['type'] == "app") {
	foreach ($data as $value) {
		$dataCount = array(
			'id' => (float)$value['idQuestion'],
			'titel' => $value['titel'],
			'text' => $value['Text'],
			'photo' => base64_encode($value['Photo']),
			'video' => $value['Video'],
			'Active' => $value['Active'],
			'Location_idLocation' => (float)$value['Location_idLocation'],
			'answer1' => $value['answer1'],
			'answer2' => $value['answer2'],
			'answer3' => $value['answer3'],
			'answer4' => $value['answer4'],
			'type' => $value['type']
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
	
$json = json_encode($dataArray);

header('Content-Type: application/json');
echo $json;
