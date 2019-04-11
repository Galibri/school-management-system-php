<?php
	ob_start();
	require_once "../functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Student Profile</title>
	<!-- stylesheet -->
	<link rel="stylesheet" tpe="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" tpe="text/css" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" tpe="text/css" href="style.css">
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="my_result.php"><i class="fa fa-graduation-cap"></i> Results</a></li>
				<li><a href="my_routine.php"><i class="fa fa-book"></i> Routine</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right navbar-user">
				<li><a href="../index.php" target="_blank">Visit Website</a></li>
				<li class="dropdown user-dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo get_name_by_session(); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
						<li class="divider"></li>
						<li><a href="../logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
					</ul>
				</li>
			</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
		<div class="container">
			<div class="row">
				<div class="col-md-12">