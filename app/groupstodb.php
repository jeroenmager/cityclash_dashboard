<?php
require ('assets/db/config.php');
require('assets/classes/addtodb.class.php');

$group = new Database();

$groupName = 0;
$groupPassword = 0;
$groupRole = 0;

if (isset($_POST['GroupName']) && isset($_POST['GroupPassword']) && isset($_POST['GroupRole'])){
    if($_POST['GroupName'] != '' || $_POST['GroupPassword'] != '' || $_POST['GroupRole'] != ''){
        $groupName = $_POST['GroupName'];
        $groupPassword = $_POST['GroupPassword'];
        $groupRole = $_POST['GroupRole'];
        

        $group->set_group($groupRole, $groupName, $groupPassword);
        $group->db_execute();
        echo "test";

    }else{
        echo 'één of meerdere velden zijn leeg';
    }
}else{
    echo 'Er is iets fout gegaan';
}

