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

      <title>Leidos Sign In</title>
    
      <script src="https://use.fontawesome.com/eedb59a6cd.js"></script>
  
      <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
   </head>
   <body>
      <div id="login-container">
         <h1>Sign In</h1>
         <?php echo form_open("login");?>

            <p>
              <?php echo lang('login_identity_label', 'identity');?>
              <?php echo form_input($identity, '', 'placeholder="example@example.com"');?>
            </p>

            <p>
              <?php echo lang('login_password_label', 'password');?>
              <?php echo form_input($password, '', 'placeholder="password"');?>
            </p>
            
            <div id="infoMessage"><?php echo $message;?></div>
            <div class="row">
               <p class="col-xs-6">
                 <?php echo lang('login_remember_label', 'remember');?>
                 <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
               </p>

               <a class="col-xs-6" href="passforgot"><?php echo lang('login_forgot_password');?></a>
            </div>

            <div class="row" id="submit-row">
               <?php echo form_submit('submit', lang('login_submit_btn'));?>
               <div id="login-logo">
                  <img src="assets/img/leidos-logo.png" alt="Leidos logo">
                  <p>Powered by Purple Sky &#169 2017</p>
               </div>
            </div>

         <?php echo form_close();?>
      </div>
      <a class="g-button" href="<?php echo site_url('register') ?>">Create profile</a>
      <br/>
      <br/>
   </body>
</html>