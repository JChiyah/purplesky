<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en-GB">
  <head>
    <meta charset="utf-8">
    <meta name="description" content=" <?php echo $des ?? '' ?> ">
    <meta name="keywords" content="">
    <meta name="viewport" content="initial-scale=1">

    <title><?php echo $title ?? '' ?></title>
    
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

          <div id="infoMessage"><?php echo $message;?></div>

          <?php echo form_open("login");?>

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

          <p><a href="auth/forgot_password"><?php echo lang('login_forgot_password');?></a></p>
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