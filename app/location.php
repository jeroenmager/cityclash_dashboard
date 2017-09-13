<?php

require ('assets/db/config.php');
require('assets/classes/addtodb.class.php');
$new_locatie = new Database();

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title> Locatie</title>

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
    <script src="assets/js/demo.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        <div class="sidebar-wrapper">
             <div class="logo">
                <a href="http://www.schoolclash.eu/" class="simple-text">
                    SchoolClash
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
                    <a href="questions.php">
                        <i class="pe-7s-science"></i>
                        <p>Vragenlijst</p>
                    </a>
                </li>
                <li>
                    <a href="results.php">
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
                    <a class="navbar-brand" href="#">Locaties</a>
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
                                <h4 class="title">Locatie Toevoegen</h4>
                                <p class="category">Een nieuw locatie toevoegen naar de database</p>
                                <?php
                                    
                                    if (isset($_POST['locName']) && isset($_POST['locLat']) && isset($_POST['locLng'])){
                                        if($_POST['locName'] != '' || $_POST['locLat'] != '' || $_POST['locLng'] != ''){
                                            $locNaam = $_POST['locName'];
                                            $locLat = $_POST['locLat'];
                                            $locLng = $_POST['locLng'];


                                    //        set new locatie
                                            $new_locatie->set_location($locNaam, $locLat, $locLng);
                                            $new_locatie->db_execute();
                                            echo '<div class="alert alert-success">
                                                <strong>Success!</strong> Locatie is toegevoegd aan de Database!
                                                </div>
                                                ';
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
                                                    <label for="locName">Locatie Naam</label>
                                                    <input type="text" name="locName" class="form-control" placeholder="Locatie Naam" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="locLat">Locatie Latitude</label>
                                                    <input type="text" name="locLat" class="form-control" placeholder="Locatie Lat" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="locLng">Locatie Longtitude</label>
                                                    <input type="text" name="locLng" class="form-control" placeholder="Locatie Lng" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right">Add Location</button>
                                        <div class="clearfix"></div>
                                    </form>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
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
   

</body>
</html>