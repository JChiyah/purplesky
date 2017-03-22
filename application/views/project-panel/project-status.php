<h2>Edit Project Status</h2>
<hr>
<p>Here you can change the project status.<br/>
Any changes made will be notified to the staff working on the project and some changes may require admin aproval.</p>

<p><strong>Current status:</strong> <?= ucfirst($project->status) ?> <span class="circle <?= $status ?>"></span></p>

<div class="container-fluid content-small" <?php echo $action == 'status' ? 'style="display: none"' : '' ?>>
	<?php echo form_open('', array('id' => 'edit-status')); ?>
		<label>New status:</label>
		<?php echo form_dropdown($edit_project['status'], $all_status, array_search(ucfirst($project->status), $all_status)); ?>
		<?php echo form_submit('submit', 'Save changes', "id='edit-status-submit'");?>
	<?php echo form_close(); ?>
</div>

<div id="another-status" <?php echo $action == 'status' ? '' : 'style="display: none"' ?>>
	<span class="confirm-msg">Project status changed!</span>
	<i class="fa fa-check fa-5x green-c" aria-hidden="true"></i>					
	<button class="g-button">Change status again</button>
</div>