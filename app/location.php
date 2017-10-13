<?php

require ('assets/db/config.php');
require('assets/classes/addtodb.class.php');
require('assets/functions/geoCoding.php');
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
						<a href="location.php"><i class="pe-7s-map-2"></i>
						<p>Locaties</p></a>
					</li>
					<li class="active">
						<a href="groups.php"><i class="pe-7s-user"></i>
						<p>Groepen</p></a>
					</li>
					<li>
						<a href="questions.php"><i class="pe-7s-science"></i>
						<p>Vragenlijst</p></a>
					</li>
					<li>
						<a href="results.html"><i class="pe-7s-folder"></i>
						<p>Resultatenlijst</p></a>
					</li>
                                        <li>
						<a href="gallery.php"><i class="pe-7s-photo"></i>
						<p>Gallerij</p></a>
					</li>
					<li>
						<a href="maps.html"><i class="pe-7s-map-marker"></i>
						<p>Maps</p></a>
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
                                    
                                    if (isset($_POST['locName']) && isset($_POST['locAdd'])){
                                        if($_POST['locName'] != '' || $_POST['locAdd'] != ''){
                                            $locNaam = $_POST['locName'];
                                            $locAdd = $_POST['locAdd'];
                                            $addres_data = geocode($locAdd);
                                            
                                            if ($addres_data){
                                                $latitude = $addres_data[0];
                                                $longitude = $addres_data[1];
                                            }else{
                                                $latitude = "undefined";
                                                $longitude = "undefined";
                                            }

                                    //        set new locatie
                                            $new_locatie->set_location($locNaam, $latitude, $longitude);
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
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="locAdd">Locatie Adres ( Address + Stad & land )</label>
                                                    <input type="text" name="locAdd" class="form-control" placeholder="eg: Kurfürstendamm Berlijn Duitsland" value="">
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Lijst van Locaties</h4>
                                <p class="category">Locatie lijst</p>
                                <?php
                                $del_Location = new Database();
                                
                                if (isset($_GET['del']) && $_GET['del'] != '') {
                                    $del_id = $_GET['del'];
                                    $del_Location->del_location($del_id);
                                    $del_Location->db_execute();
                                    echo '<script>alert("Locatie is verwijderd");window.location.href = "http://' . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"] . '";</script>';
                                }
                                ?>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Locatie ID</th>
                                            <th>Locatie Naam</th>
                                            <th>Locatie Lat</th>
                                            <th>Locatie Lng</th>
                                            <th>Verwijder locatie?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getLocations = new Database();
                                        $getLocations->get_locations();
                                        $getLocations->db_execute();

                                        $locationsList = $getLocations->resultset();
                                        foreach ($locationsList as $Llist) {
                                            ?>
                                            <tr>
                                                <td><?php echo $Llist['idLocation'] ?></td>
                                                <td><?php echo $Llist['Name'] ?></td>
                                                <td><?php echo $Llist['latitude'] ?></td>
                                                <td><?php echo $Llist['longitude'] ?></td>
                                                <td>
                                                    <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                                                        <div class="font-icon-detail">
                                                            <i class="pe-7s-pen"></i>
                                                        </div>
                                                    </div>
                                                    <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                                                        <a href="?del=<?php echo $Llist['idLocation'] ?>"><div class="font-icon-detail">
                                                                <i class="pe-7s-trash"></i>
                                                            </div></a>
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