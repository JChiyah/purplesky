<h1>Hello World!</h1>


		<title>Home</title>

		<script src="https://use.fontawesome.com/eedb59a6cd.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
	</head>
	<body>
		<?php include ('inc/navbar.php'); ?>

		<!--TODO::Go over this with the team to decide what element every item needs to be because
		some of the display functions requires access to the databse/user data and that can be displayed in
		many ways using JS, HTML etc.-->

		<div class="container">
			<br>
			<!--Notification and date row-->
			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-7">Notifications
					<hr>
					<!--How are going to implement the notification system? using a table?-->
					<table>
						<tr>
							<th>
								Date Time
							</th>
						</tr>
						<tr>
							<th>
								Notification at "Project Link".
							</th>
						</tr>
						<tr>
							<th>
								Date Time
							</th>
						</tr>
						<tr>
							<th>
								Notification at "Project Link".
							</th>
						</tr>
					</table>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-5">Date
					<br>
					<hr>
					<!--Calander implementation-->
					<p>Calander placeHolder</p>
				</div>
			</div>
			<br>
			<!--Current projects and Recomended for you-->
			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-5">Current Projects
					<hr>
					<br>
					<!--current project show as buttons/links? - replace link with var the comes from DB-->
					<button type="button" name="Project" onclick="location.href='http://google.com'">Project A</button>
					<button type="button" name="Project" onclick="location.href='http://google.com'">Project B</button>
					<button type="button" name="Project" onclick="location.href='http://google.com'">Project C</button>
				</div>
				<!--Recomended Section -->
					<div class="col-xs-12 col-md-6 col-lg-7">Recomended for you
						<hr>
						<br>
						<!--Create a new row here and divide the space evenly for each project section
								3 cols each, leaves border space for arrows and styling-->
						<!--info glyph icon needed-->
						<div class="row">
							<div class="col-xs-12 col-md-3 col-lg-5">
								<!--Bootstrap will let you nest grids within themselfs, use that-->
								<!--div class box containter needed-->
								<h3>ProjectD</h3>
								<p>Description</p>
								<p>Location</p>
								<p>Project Manager</p>
								<p>From "StartDate" to "EndDate"</p>
							</div>
							<div class="col-xs-12 col-md-3 col-lg-5">
								<!--div class box containter needed-->
								<h3>ProjectE</h3>
								<p>Description</p>
								<p>Location</p>
								<p>Project Manager</p>
								<p>From "StartDate" to "EndDate"</p>
							</div>
						</div>
					</div>
				</div>

		</div>	<!--Container end-->

		<?php include ('inc/footer.php'); ?>
	</body>
</html>
