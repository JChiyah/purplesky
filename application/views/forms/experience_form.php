<div id="change-password">
      <h1><?php echo lang('change_password_heading');?></h1>

      <?php echo form_open("change-password");?>
            
            <div id="infoMessage"><?php echo $message;?></div>

            <p>
                  <?php echo lang('change_password_old_password_label', 'old_password');?>
                  <?php echo form_input($old_password,'',"required");?>
            </p>

            <p>
                  <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label>
                  <?php echo form_input($new_password,'',"required");?>
            </p>

            <p>
                  <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?>
                  <?php echo form_input($new_password_confirm,'',"required");?>
            </p>

            <?php echo form_input($user_id);?>
            <p><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>

      <?php echo form_close();?>
</div>