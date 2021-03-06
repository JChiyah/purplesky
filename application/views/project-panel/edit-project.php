<h2>Edit Project Details</h2>
<hr>
	
<p>Here you can edit project details such as its title, description or date</p>

<div class="container-fluid content" <?php echo isset($action) && $action == 'edit' ? 'style="display: none"' : '' ?>>
<?php echo form_open('', array('id' => 'edit-project-form'));?>

	<div class="container-fluid" id="edit-details">

		<p>
			<label>Title:</label>
			<?php echo form_input($edit_project['title'], '', 'maxlength="90"');?>
		</p>
		<p>
			<label>Description:</label>
			<?php echo form_textarea($edit_project['description'], '', 'maxlength="250" rows="5"');?>
			<br/><span>250 characters maximum</span>
		</p>
		<div class="row" id="project-dates">
			<p class="col-xs-12 col-sm-6 col-md-4">
				<label>From:</label>
				<?php echo form_date($edit_project['start_date']);?>
			</p>
			<p class="hidden-sm col-md-2"></p>
			<p class="col-xs-12 col-sm-6 col-md-4">
				<label>To:</label>
				<?php echo form_date($edit_project['end_date']);?>
			</p>
			<p class="hidden-sm col-md-2"></p>
		</div>
		<p>
			<label>Location:</label>
			<?php echo form_dropdown($edit_project['location'], $locations, $current_location);?>
		</p>
		<p id="priority-buttons">
			<b>Priority:</b><br/>
			<?php echo form_radio($edit_project['normal_priority']);?><?php echo form_label('Normal', 'normal');?>
			<?php echo form_radio($edit_project['high_priority']);?><?php echo form_label('High', 'high');?>
			<?php echo form_radio($edit_project['confidential_priority']);?><?php echo form_label('Confidential', 'confidential');?>
		</p>
		<p>
			<label>Budget:</label>
			£ <?php echo form_input($edit_project['budget']);?>
		</p>

		<button type="button" class="project-continue">Continue</button>
	</div>

	<div class="container-fluid" id="project-summary" style="display: none">
		<p>These are the new details of the project. Please check that all information is correct.</p>
	
		<h1 id="title_summary"><?= $project->title ?></h1>
		<h3><?= $project->manager ?></h3>

		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6">
				<p>
		    		<b>Start date:</b>
		    		<span id="start_date_summary"><?= $project->start_date ?></span>
		    	</p>
		    	<p>
		    		<b>End date:</b>
		    		<span id="end_date_summary"><?= $project->end_date ?></span>
		    	</p>
		    	<p>
		    		<b>Budget:</b>
		    		£ <span id="budget_summary"><?= $project->budget ?></span>
		    	</p>
		    </div>
		    <div class="col-xs-6 col-sm-6 col-md-6" id="right-div">
		    	<p>
		    		<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
		    		<span id="location_summary"><?= $project->location ?></span>
		    	</p>
				<p>
		    		<span id="priority_summary"><?= ucfirst($project->priority) ?></span>
		    		priority
		    	</p>
		    </div>
		</div>
		<p id="description_summary"><?= $project->description ?></p><br/>

		<button type="button" class="project-back">Back</button>

		<?php echo form_submit('submit', 'Save changes', "id='edit-project-submit'");?>
	</div>

<?php echo form_close(); ?>
</div>

<div class="container-fluid" id="project-confirmation" <?php echo isset($action) && $action == 'edit' ? '' : 'style="display: none"' ?>>
	<i class="fa fa-check fa-5x green-c" aria-hidden="true"></i>
	<h3>You have changed the project details succesfully!</h3>
</div>

