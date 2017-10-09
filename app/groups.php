<?php 

require ('assets/db/config.php');
require('assets/classes/addtodb.class.php');

$group = new Database();
$del_User = new Database();

$groupName = 0;
$groupPassword = 0;
$groupRole = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="assets/img/favicon.ico" rel="icon" type="image/png">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<title>Groepen</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
	<meta content="width=device-width" name="viewport"><!-- Bootstrap core CSS     -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet"><!-- Animation library for notifications   -->
	<link href="assets/css/animate.min.css" rel="stylesheet"><!--  Light Bootstrap Table core CSS    -->
	<link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"><!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="assets/css/demo.css" rel="stylesheet"><!--     Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
	<link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
			<!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->
			<div class="sidebar-wrapper">
				<div class="logo">
					<a class="simple-text" href="http://www.schoolclash.eu/">Schoolclash</a>
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
						<button class="navbar-toggle" data-target="#navigation-example-2" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> <a class="navbar-brand" href="#">Groepen</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-left"></ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="#">
								<p>Log out</p></a>
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
									<h4 class="title">Groepen toevoegen</h4>
                                                                        <?php
                                                                        

                                                                        if (isset($_POST['GroupName']) && isset($_POST['GroupPassword']) && isset($_POST['GroupRole'])){
                                                                            if($_POST['GroupName'] != '' || $_POST['GroupPassword'] != '' || $_POST['GroupRole'] != ''){
                                                                                $groupName = $_POST['GroupName'];
                                                                                $groupPassword = $_POST['GroupPassword'];
                                                                                $groupRole = $_POST['GroupRole'];


                                                                                $group->set_group($groupRole, $groupName, $groupPassword);
                                                                                $group->db_execute();
                                                                                echo '<div class="alert alert-success">
                                                                                    <strong>Success!</strong> Groep is toegevoegd
                                                                                    </div>
                                                                                    ';

                                                                            }else{
                                                                                echo '<div class="alert alert-danger">
                                                                                    <strong>Failed!</strong> één of meerdere velden zijn leeg
                                                                                    </div>
                                                                                    ';
                                                                            }
                                                                        }

                                                                        ?>

								</div>
								<div class="content table-responsive table-full-width">
									<div class="content">
										<form action="" enctype="multipart/form-data" method="post">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label for="GroupName">Groep naam</label> <input class="form-control" name="GroupName" placeholder="Groep naam" type="text" value="">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="GroupPassword">Groep wachtwoord</label> <input class="form-control" name="GroupPassword" placeholder="Groep wachtwoord" type="text" value="">
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<label for="GroupRole">Groep rol</label> <select class="form-control" name="GroupRole">
															<option value="0">
																Gebruiker
															</option>
															<option value="1">
																Admin
															</option>
														</select>
													</div>
												</div>
											</div><button class="btn btn-info btn-fill pull-right" type="submit">Groep toevoegen</button>
											<div class="clearfix"></div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="header">
							<h4 class="title">Groepen</h4>
							<p class="category">Groepen verwijderen</p>
                                                        <?php 
                                                        if(isset($_GET['del']) && $_GET['del'] != ''){
                                                            $del_id = $_GET['del'];
                                                            $del_User->del_user($del_id);
                                                            $del_User->db_execute();
                                                            echo '<script>alert("Groep is verwijderd");window.location.href = "http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"].'";</script>';
                                                        }
                                                        ?>
						</div>
						<div class="content table-responsive table-full-width">
							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>Groep nr</th>
										<th>Groepsnaam</th>
										<th>Wachtwoord</th>
										<th>Actief</th>
										<th>Role</th>
										<th>Verwijderen groep</th>
									</tr>
								</thead>
								<tbody>
                                                                    <?php 
                                                                    
                                                                    $getGroups = new Database();
                                                                    $getGroups->get_groups();
                                                                    $getGroups->db_execute();
                                                                    
                                                                    $groupsList = $getGroups->resultset();
                                                                    foreach($groupsList as $Glist){ ?>
									<tr>
										<td><?php echo $Glist['idUser']?></td>
										<td><?php echo $Glist['Name']?></td>
										<td><?php echo $Glist['Password']?></td>
										<td><select class="form-control" name="Active" disabled>
											<option>
                                                                                                <?php if($Glist['Active'] == "0"){echo "No";}elseif($Glist['Active'] == "1"){echo "Yes";}?>
											</option>
										</select></td>
										<td><?php if($Glist['Role'] == "0"){echo "Gebruiker";}elseif($Glist['Role'] == "1"){echo "Admin";}?></td>
										<td>
											<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
												<div class="font-icon-detail">
													<i class="pe-7s-pen"></i>
												</div>
											</div>
											<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
												<a href="?del=<?php echo $Glist['idUser']?>"><div class="font-icon-detail">
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
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-13">
							<div class="card">
								<div class="header">
									<h4 class="title">Organisatie toevoegen</h4>
								</div>
								<div class="content table-responsive table-full-width">
									<div class="content">
										<form action="groupstodb.php" enctype="multipart/form-data" method="post">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label for="OrgName">Organisatie naam</label> <input class="form-control" name="OrgName" placeholder="Organisatie naam" type="text" value="">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="OrgDate">Datum</label> <input class="form-control" name="OrgDate" placeholder="Groep wachtwoord" type="date" value="">
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<label for="OrgDESC">Extra informatie</label> <input class="form-control" name="OrgDESC" placeholder="Extra informatie" type="text" value="">
													</div>
												</div>
											</div><button class="btn btn-info btn-fill pull-right" type="submit">Organisatie toevoegen</button>
											<div class="clearfix"></div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-14">
					<div class="card">
						<div class="header">
							<h4 class="title">Organisaties</h4>
						</div>
						<div class="content table-responsive table-full-width">
							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>Organisatie nr</th>
										<th>Organisatie naam</th>
										<th>Datum</th>
										<th>Actief</th>
										<th>Desc</th>
										<th>Type</th>
										<th>Verwijderen groep</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td></td>
										<td></td>
										<td><select class="form-control" name="Active">
											<option value="Yes">
												Ja
											</option>
											<option value="No">
												Nee
											</option>
										</select></td>
										<td></td>
										<td></td>
										<td>
											<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
												<div class="font-icon-detail">
													<i class="pe-7s-pen"></i>
												</div>
											</div>
											<div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
												<div class="font-icon-detail">
													<i class="pe-7s-trash"></i>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--   Core JS Files   -->
	<script src="assets/js/jquery-1.10.2.js" type="text/javascript">
	</script> 
	<script src="assets/js/bootstrap.min.js" type="text/javascript">
	</script> <!--  Checkbox, Radio & Switch Plugins -->
	 
	<script src="assets/js/bootstrap-checkbox-radio-switch.js">
	</script> <!--  Charts Plugin -->
	 
	<script src="assets/js/chartist.min.js">
	</script> <!--  Notifications Plugin    -->
	 
	<script src="assets/js/bootstrap-notify.js">
	</script> <!--  Google Maps Plugin    -->
	 
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript">
	</script> <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	 
	<script src="assets/js/light-bootstrap-dashboard.js">
	</script> <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	 
	<script src="assets/js/demo.js">
	</script>
</body>
</html>