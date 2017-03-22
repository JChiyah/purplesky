<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en-GB">
   <head>
      <meta charset="utf-8">
      <meta name="description" content="Register">
      <meta name="keywords" content="">
      <meta name="viewport" content="initial-scale=1">

      <title>Register</title>

      <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
      <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
      <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
      <script>
      window.addEventListener("load", function(){
      window.cookieconsent.initialise({
        "palette": {
          "popup": {
            "background": "#1f1646"
          },
          "button": {
            "background": "#0389ff"
          }
        },
        "theme": "classic",
        "position": "bottom-left",
        "content": {
          "message": "This website uses cookies to ensure you get the best experience. By continuing to use this website, you agree the use of cookies",
          "dismiss": "Accept and Close"
        }
      })});
      </script>
   </head>
   <body>
      <div class="container" id="login-container">
         <h1>Create Profile</h1>
         <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12">

               <?php echo form_open("Auth/create_user");?>
                     
                     <p>Please fill out all fields</p>
                     <p>
                        <?php echo lang('create_user_fname_label', 'first_name');?>
                        <?php echo form_input($first_name);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_lname_label', 'last_name');?>
                        <?php echo form_input($last_name);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_email_label', 'email');?>
                        <?php echo form_input($email);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_password_label', 'password');?>
                        <?php echo form_input($password);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
                        <?php echo form_input($password_confirm);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_type_label', 'user_group');?>
                        <?php echo form_dropdown($groups, array('Admin','Project Manager','Employee','Contractor'), array(2));?>
                     </p>

                     <div id="infoMessage"><?php echo (isset($message)) ? $message : ''; ?></div>

                     <p><?php echo form_submit('submit', lang('continue_label'));?></p>

               <?php echo form_close();?>
            </div>
         </div>
      </div>
   </body>
</html>
