<?php

require ('../../assets/db/config.php');
require('../../assets/classes/addtodb.class.php');
$getImages = new Database();

if(isset($_GET['id']) && $_GET['id'] != ''){
$image_id = $_GET['id'];

$getImages->get_images($image_id);

$image_data = $getImages->resultset();

$image = base64_encode($image_data[0]['Photo']);

header ('Content-Type: image/png');
echo 'data:image/jpeg;base64,'. $image;

}else{
    echo "failed to load data";
}