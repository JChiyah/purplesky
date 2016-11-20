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
		<h1><?php echo lang('login_heading');?></h1>
		<p><?php echo lang('login_subheading');?></p>

		<?php echo form_open("auth/login");?>

		  <p>
		    <?php echo lang('login_identity_label', 'identity');?>
		    <?php echo form_input($identity);?>
		  </p>

		  <p>
		    <?php echo lang('login_password_label', 'password');?>
		    <?php echo form_input($password);?>
		  </p>

		  <p>
		    <?php echo lang('login_remember_label', 'remember');?>
		    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
		  </p>


		  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

		<?php echo form_close();?>

		<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>

	</body>
</html>