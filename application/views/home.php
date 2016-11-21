<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="initial-scale=1">

		<title>Home</title>

		<script src="https://use.fontawesome.com/eedb59a6cd.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
	</head>
	<body>
		<?php include ('inc/navbar.php'); ?>

		<h1>Nav bar placeholder</h1>

		<!-- Simple grid example
		Check https://v4-alpha.getbootstrap.com/layout/grid/
		for more information on the grid system and layout

		Check http://getbootstrap.com/css/#responsive-utilities
		for responsive tools and classes, such as .hidden-xs

		SIZE CHART GUIDE
		    md - medium   | some tablets and small desktops
		    lg - large    | desktops
		-->

		<div class="container">
			<br>
			<!--Notification and date row-->
			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-7">Notifications
					<hr>
					<!--How are going to implement the notification system? using a table?-->
				</div>
				<div class="col-xs-12 col-md-6 col-lg-5">Date
					<br>
					<hr>
					<!--Calander implementation-->
				</div>
			</div>
			<br>
			<!--Current projects and Recomended for you-->
			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-4">Current Projects
					<hr>
					<br>
					<!--current project show as buttons/links?-->
				</div>
				<div class="col-xs-12 col-md-6 col-lg-8">Recomended for you
					<hr>
					<br>
					<!--Create a new row here and divide the space evenly for each project section
							3 cols each, leaves border space for arrows and styling-->
					<!--info glyph icon needed-->
				</div>
			</div>

		</div>	<!--Container end-->

		<?php include ('inc/footer.php'); ?>
	</body>
</html>
