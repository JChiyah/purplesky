<h2>Edit Applications Status</h2>
<hr>
<p>Here you can change whether the project accepts applications or nots.<br/>
If the project is open to new applications, employees can send applications that you can review. 
A closed project will not receive any applications.<br/>You can change at any time whether your project can accept applications, as long as the project is not confidential or finished.</p>

<p><strong>Current status:</strong> <?= ucfirst($project->applications) ?> <span class="circle <?php echo $project->applications == 'open' ? 'green' : 'red' ?>"></span></p>

<div class="container-fluid content-small" <?php echo $action == 'application-status' ? 'style="display: none"' : '' ?>>
	<?php echo form_open('', array('id' => 'application-status-form')); ?>
		<label>New status:</label>
		<?php echo form_dropdown($edit_project['application_status'], array('Open', 'Closed'), array_search($project->applications, array('open', 'closed'))); ?>
		<?php echo form_submit('submit', 'Save changes', "id='edit-application-status-submit'");?>
	<?php echo form_close(); ?>
</div>

<div id="another-application-status" <?php echo $action == 'application-status' ? '' : 'style="display: none"' ?>>
	<span class="confirm-msg">Project Application Status Changed!</span>
	<i class="fa fa-check fa-5x green-c" aria-hidden="true"></i>					
	<button>Change Application Status</button>
</div>