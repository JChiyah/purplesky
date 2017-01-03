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

		<title>Login</title>

		<script src="https://use.fontawesome.com/eedb59a6cd.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
	</head>


	<body>

		<div class="container">
			<!--setting the grid container to center-->
			<div class="col-xs-2 col-xs-offset-5 col-lg-2 col-lg-offset-5">
				<div class="row">
					<h1>Sign in</h1>
			    <form method = "post" action = "Login.php">
						<p>Email<br><input class="contact" type="text" name="email" value="" /></p>
						<p>Password<br><input class="contact" type="password" name="password" value="" /></p>
						<a href="">Forgotten your password?</a>
						<br>
						<br>
						<input type = "submit" value = "Sign In"/>
					</form>
				</div>
				<div class="row">
					<!--TODO-->
					<img src="assets/img/leidos-logo.png" alt="Leidos logo">
					<p>Powered by Purple Sky 2016</p>
				</div>
			</div>
		</div>

	</body>
</html>
