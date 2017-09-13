<?php

$json = file_get_contents("http://cityclash.icthardenberg.nl/dev/app/data/questions.php?type=maps");
$json_array = json_decode($json);

foreach($json_array as $key => $value) {
    echo $value->text . ", " . $value->type . "<br>";
  }
