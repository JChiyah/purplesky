<div class="container">
  <h1>Create Profile</h1>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-12"><sub>Please fill out all fields</sub>
      <div id="infoMessage"><?php echo $message;?></div>

      <?php echo form_open("auth/create_user");?>

            <p>
               <?php echo lang('create_user_fname_label', 'first_name');?> <br />
               <?php echo form_input($firstName);?>
            </p>

            <p>
               <?php echo lang('create_user_lname_label', 'last_name');?> <br />
               <?php echo form_input($lastName);?>
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
               <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
               <?php echo form_input($groups,'value="1"','type="radio"');?>
               <?php echo form_input($groups,'value="2"','type="radio"');?>
            </p>

            <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>

      <?php echo form_close();?>

      <form class="" action="index.html" method="post">
        Title: <br>
        <select name="title" required>
          <option value="Mr.">Mr.</option>
          <option value="Mrs.">Mrs.</option>
          <!--TODO::What other titiles are in list?-->
        </select>
        <p></p>
        First Name: <br>
        <input type="text" name="firstName" value="" required>
        <p></p>
        Surname: <br>
        <input type="text" name="surname" value="" required>
        <p></p>
        Email:<br>
        <input type="email" name="email" value="exampleemail@hotmail.com" required>
        <p></p>
        Choose password: <br>
        <input type="text" name="password" value="password" required>
        <p></p>
        Re-type password: <br>
        <input type="text" name="rePassword" value="password" required>
        <p></p>
        Location: <br>
        <select name="location" required>
          <option value="test1">Test1</option>
          <option value="test2">Test2</option>
        </select>
        <input type="submit" name="submit" value="Submit">
      </form>
    </div>
  </div>
</div>
