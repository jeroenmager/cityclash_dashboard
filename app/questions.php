<?php

require ('assets/db/config.php');
require ('assets/classes/addtodb.class.php');

include ('assets/img/resize_image.php');
$new_question = new Database();
$del_question = new Database();


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SchoolClash</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Schoolclash
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="location.php">
                        <i class="pe-7s-graph"></i>
                        <p>Locaties</p>
                    </a>
                </li>
                <li class="active">
                    <a href="groups.html">
                        <i class="pe-7s-user"></i>
                        <p>Groepen</p>
                    </a>
                </li>
                <li>
                    <a href="loctoevent.html">
                        <i class="pe-7s-note2"></i>
                        <p>Locaties koppelen aan een event</p>
                    </a>
                </li>
                <li>
                    <a href="evtogroup.html">
                        <i class="pe-7s-news-paper"></i>
                        <p>Event koppelen aan groep</p>
                    </a>
                </li>
                <li>
                    <a href="question.php">
                        <i class="pe-7s-science"></i>
                        <p>Vragenlijst</p>
                    </a>
                </li>
                <li>
                    <a href="results.html">
                        <i class="pe-7s-bell"></i>
                        <p>Resultatenlijst</p>
                    </a>
                </li>
                <li>
                    <a href="maps.html">
                        <i class="pe-7s-map-marker"></i>
                        <p>Maps</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Vragenlijst</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                       
                       
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                      
                        <li>
                            <a href="#">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Vragen</h4>
                                <p class="category">Vragen toevoegen</p>
                                <?php
                                    
                                    if (isset($_POST['question'])){
                                        if($_POST['question'] != ''){
                                            $question = $_POST['question'];
                                            $type = $_POST['TypeQ'];
                                            $LocID = $_POST['LocId'];
                                            $answer1 = $_POST['answer1'];
                                            $answer2 = $_POST['answer2'];
                                            $answer3 = $_POST['answer3'];
                                            $answer4 = $_POST['answer4'];
                                            

                                            /*-------------------
                                            IMAGE QUERY 
                                            ---------------*/

//
//                                            $file   =$_FILES['image']['tmp_name'];
//                                            if(!isset($file))
//                                            {
//                                              echo 'Please select an Image';
//                                            }
//                                            else 
//                                            {
//                                                $image = file_get_contents($_FILES['image']['tmp_name']);
//                                                
////                                                set new Question
//                                                $new_question->set_question($question, $image, $type);
//                                                $new_question->db_execute();
//                                                echo '<div class="alert alert-success">
//                                                    <strong>Success!</strong> Vraag is toegevoegd aan de Database!
//                                                    </div>
//                                                    ';
//                                               
//                                           }
                                            
                                             if ($_FILES["image"]["error"] > 0)
                                            {
                                               echo '<div class="alert alert-success">
                                                    <strong>Success</strong> Vraag is toeggevoegd aan de database!
                                                    </div>
                                                    ';
                                               $new_question->set_question($question, "", $type, $LocID, $answer1, $answer2, $answer3,$answer4);
                                               $new_question->db_execute();
                                             }
                                             elseif($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpeg')
                                             {
                                               move_uploaded_file($_FILES["image"]["tmp_name"],"assets/img/upload/" . $_FILES["image"]["name"]);
                                               echo '<div class="alert alert-success">
                                                    <strong>Success!</strong> Afbeelding Opgeslagen!
                                                    </div>
                                                    ';

                                               $file="assets/img/upload/".$_FILES["image"]["name"];
                                               $new_question->set_question($question, $file, $type, $LocID, $answer1, $answer2, $answer3,$answer4);
                                               $new_question->db_execute();

                                               
                                               echo '<div class="alert alert-success">
                                                    <strong>Success!</strong> Vraag is toegevoegd aan de Database!
                                                    </div>
                                                    ';

                                             } else{
                                                 echo '<div class="alert alert-danger">
                                                    <strong>failed!</strong> Afbeelding heeft geen JPEG, JPG of PNG extensie
                                                    </div>
                                                    ';
                                             }
                                            
                                                /*-----------------
                                            IMAGE QUERY END
                                            ---------------------*/

                                   
                                        }else{
//                                            $new_locatie->generate_message("één of meerdere velden zijn leeg");
                                                echo '<div class="alert alert-warning">
                                                <strong>Let Op!</strong> Een of meerdere velden zijn niet ingevult!
                                                </div>
                                                ';
                                        }
                                    }
                                    
                                    ?>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <div class="content">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="question">Vraag</label>
                                                    <input type="text" name="question" class="form-control" placeholder="Vraag" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="Picture">Foto</label>
                                                    <input type="file" class="form-control" name="image">
                                                </div>
                                            </div>
                                            <?php
                                            $Qlocaties = new Database();

                                            $Qlocaties->get_locations();
                                            $Qlocaties->db_execute();
                                            $Rlocaties = $Qlocaties->resultset();
                                            
                                            ?>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="LocId">Locatie ID</label>
                                                    <select name="LocId" class="form-control">
                                                        <?php foreach($Rlocaties as $Rloc){ ?>
                                                    <option value="<?php echo $Rloc['idLocation']?>"><?php echo $Rloc['idLocation']. ' - ' .$Rloc['Name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="TypeQ">Type vraag</label>
                                                    <select name="TypeQ" class="form-control">
                                                    <option value="OpenQ" selected>Open vraag</option>
                                                    <option value="MultiQ">Multiplechoice vraag</option>
                                                    <option value="PicQ">Foto vraag</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="MultipleC" style="display: none;">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="question">Antwoord 1</label>
                                                    <input type="text" name="answer1" class="form-control" placeholder="Vraag" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="question">Antwoord 2</label>
                                                    <input type="text" name="answer2" class="form-control" placeholder="Vraag" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="question">Antwoord 3</label>
                                                    <input type="text" name="answer3" class="form-control" placeholder="Vraag" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="question">Antwoord 4</label>
                                                    <input type="text" name="answer4" class="form-control" placeholder="Vraag" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Vraag toevoegen</button>
                                        <div class="clearfix"></div>
                                    </form>      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Vragenlijst</h4>
                                <p class="category"> Vragen bewerken / verwijderen</p>
                                <?php 
                                if(isset($_GET['del']) && $_GET['del'] != ''){
                                    $del_id = $_GET['del'];
                                    $del_question->del_question($del_id);
                                    $del_question->db_execute();
                                    echo '<script>alert("Vraag is verwijderd");window.location.href = "http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"].'";</script>';
                                }
                                ?>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <?php 
                                    $json = file_get_contents("http://cityclash.icthardenberg.nl/dev/app/data/questions.php?type=maps");
                                    $json_array = json_decode($json);

                                    
                                
                                ?>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Vraag nr</th>
                                    	<th>Vraag</th>
                                    	<th>Foto</th>
                                    	<th>Actief</th>
                                    	<th>Locatie</th>
                                        <th>Type vraag</th>
                                        <th>Answers</th>
                                        <th>Wijzigen</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                       
                                        
                                        foreach($json_array as $key => $data) {
                                        ?>
                                        <tr>
                                        	<td><?php echo $data->id;?></td>
                                        	<td><?php echo $data->text;?></td>
                                                <td><img width="100px" height="100px" src="<?php if(!$data->photo == ''){
                                                echo $data->photo;}else{echo 'data:image/jpeg;base64,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';}?>"></td>
                                        	<td>
                                                    <input type="text" value="<?php if($data->Active === "1"){echo "Ja";}elseif($data->Active === "0"){echo "Nee";}else{echo "Fout!";} ?> " disabled></input>
                                                </td>
                                        	<td><?php echo $data->Location_idLocation;?></td>
                                            <td><?php echo $data->type;?></td>
                                            <td><b>Answer1:</b> <?php echo $data->answer1;?><br><b>Answer2:</b> <?php echo $data->answer2;?><br><b>Answer3:</b> <?php echo $data->answer3;?><br><b>Answer4:</b> <?php echo $data->answer4;?><br></td>
                                            <td>
                                             <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                                                 <a href="#"><div class="font-icon-detail"><i class="pe-7s-pen"></i></div></a>
                                            </div>
                                                
                                            <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                                                    <a href="?del=<?php echo $data->id;?>"><div class="font-icon-detail"><i class="pe-7s-trash"></i></div></a>
                                            </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
            
            
            
        </div> 
<!--        einde content div-->

        


    </div>
</div>


</body>

       <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
        
        <script>
        $( document ).ready(function() {
            $('select[name=TypeQ]').change(function () {
                if ($(this).val() === 'MultiQ') {
                    $('#MultipleC').slideDown('medium');
                } else {
                    $('#MultipleC').slideUp('medium');
                }
            });
        });
        </script>


</html>
