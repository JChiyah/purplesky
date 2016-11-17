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
	
		<h1>Hello World!</h1>

		<!-- Simple grid example -->
		<!-- 

		Check https://v4-alpha.getbootstrap.com/layout/grid/
		for more information on the grid system and layout
		
		Check http://getbootstrap.com/css/#responsive-utilities
		for responsive tools and classes, such as .hidden-xs 

		SIZE CHART GUIDE
		
		 xs - extra small | mobile phones
		    sm - small    | some phones and tablets
		    md - medium   | some tablets and small desktops
		    lg - large    | desktops
		 xl - extra large | large desktops (DON'T USE)
		
		The xl should not be used at any point (ask Javi why if you need more information).
		We assume the normal version of the web application will be used by desktops, thus large = lg 
		is the common measure. Code starting from there. This mean: make the desktop version with lg
		look nice, and then add other classes to make other versions look good. 

		-->

		<div class="container">
		  	<div class="row">
				<!-- A row with 3 equally divided columns -->
		    	<div style="background: red" class="col-xs-12 col-md-4">
		      		One of three columns
		    	</div>
			    <div style="background: blue" class="col-xs-12 col-md-4">
			      	One of three columns
			    </div>
			    <div style="background: gray" class="col-xs-12 col-md-4">
			      	One of three columns
			    </div>
		  	</div>
		  	<div class="row">
		  		<!-- A row with 2 columns -->
				<div style="background: brown" class="col-xs-12 col-md-8">col-md-8</div>
				<div style="background: green" class="col-xs-12 col-md-4">col-md-4</div>
			</div>
			<div class="row">
				<!-- A row with 2 columns -->
				<div style="background: purple" class="col-xs-6">Always 50% width col-xs-6</div>
				<div style="background: yellow" class="col-xs-6">Always 50% width col-xs-6</div>
			</div>
			<div class="row">
				<!-- A row with 4 columns which converst to 2 rows with 2 columns in mobile -->
				<div style="background: gray" class="col-xs-6 col-sm-3">Check on mobile! .col-xs-6 .col-sm-3</div>
				<div style="background: red" class="col-xs-6 col-sm-3">Check on mobile! .col-xs-6 .col-sm-3</div>
				<div style="background: blue" class="col-xs-6 col-sm-3">Check on mobile! .col-xs-6 .col-sm-3</div>
				<div style="background: green" class="col-xs-6 col-sm-3">Check on mobile! .col-xs-6 .col-sm-3</div>
			</div>
			<div class="row hidden-xs"> <!-- Order of the classes is important. Keep the class with visibility at the end -->
		  		<!-- This row completely dissapears when using a mobile phone -->
				<div style="background: yellow" class="col-xs-12 col-md-8">col-md-8</div>
				<div style="background: gray" class="col-xs-12 col-md-4">col-md-4</div>
			</div>
			<div class="row visible-sm"> <!-- Order of the classes is important. Keep the class with visibility at the end -->
		  		<!-- This row only appears when using a tablet -->
				<div style="background: purple" class="col-xs-12 col-md-8">col-md-8</div>
				<div style="background: blue" class="col-xs-12 col-md-4">col-md-4</div>
			</div>
		</div>

		<?php include ('inc/footer.php'); ?>
	</body>
</html>