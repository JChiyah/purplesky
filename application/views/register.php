<?php
   //defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en-GB">
   <head>
      <meta charset="utf-8">
      <meta name="description" content="Register">
      <meta name="keywords" content="">
      <meta name="viewport" content="initial-scale=1">

      <title>Register</title>
      
      <script src="https://use.fontawesome.com/eedb59a6cd.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

      <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
   </head>
   <body>
      <div class="container">
         <h1>Create Profile</h1>
         <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12"><sub>Please fill out all fields</sub>
               <div id="infoMessage"><?php echo $message ?? '';?></div>

               <?php echo form_open("main/create_user");?>

                     <p>
                        <?php echo lang('create_user_fname_label', 'first_name');?> <br />
                        <?php echo form_input($first_name);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_lname_label', 'last_name');?> <br />
                        <?php echo form_input($last_name);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_email_label', 'email');?> <br />
                        <?php echo form_input($email);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_password_label', 'password');?> <br />
                        <?php echo form_input($password);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
                        <?php echo form_input($password_confirm);?>
                     </p>

                     <p>
                        <?php echo lang('create_user_type_label', 'user_group');?> <br />
                        <?php echo form_dropdown($groups, array('Admin','Project Manager','Employee','Contractor'), array(2));?>
                     </p>

                     <p><?php echo form_submit('submit', lang('continue_label'));?></p>

               <?php echo form_close();?>
            </div>
         </div>
      </div>
   </body>
</html>
