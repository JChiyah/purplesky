<h2>Add Staff</h2>
<hr>

<div class="container-fluid content">
	<?php echo form_open('', array('id' => 'search-staff-form')) ?>
		<p>You can search staff for this project by skills or by name</p>
		<div class="row" id="search-dates">
			<p class="col-xs-12 col-sm-6 col-md-4">
				<label>From:</label>
				<?php echo form_date($staff_start_date);?>
			</p>
			<p class="hidden-sm col-md-2"></p>
			<p class="col-xs-12 col-sm-6 col-md-4">
				<label>To:</label>
				<?php echo form_date($staff_end_date);?>
			</p>
			<p class="hidden-sm col-md-2"></p>						
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-4">
				<label>Skills:</label>
				<?php echo form_dropdown($skill_select, array_merge(array( 0 => 'Select'), $skills));?>
				<button type="button" id="clear-skills">Clear</button>
				<div id="selected-skills"></div>
			</div>
			<div class="hidden-sm col-md-2"></div>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<button type="button" id="search-name-toggle">Search by name</button>
				<div id="search-name" style="display: none">
					<label>Employee name:</label>
					<?php echo form_input($staff_name,'', 'maxlength="50"');?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="hidden-xs col-sm-9">
			</div>
			<?php echo form_submit('submit', 'Search', "class='col-xs-12 col-sm-3' id='staff-allocation-search'");?>
		</div>

		<input type="hidden" value="<?= $current_location ?>" id="staff-location"/>
		<input type="hidden" value="<?= $project->project_id ?>" id="project_id"/>

	<?php echo form_close() ?>

</div>

<div id="search-results">
	<h2>Results</h2>
	<hr>
	<div id="results">

	</div>
</div>

<div id="profile-popup" style="display: none">
	
</div>

<div class="container-fluid content" style="display: none">
	<?php echo form_open('', array('id' => 'allocate-staff-form')) ?>

		<p>You are adding this employee to the project</p>
		
		<h3 id="staff_name_summary"></h3>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6">
				<p>
		    		<b>Start date:</b>
					<span id="staff_start_date_summary"></span>
		    	</p>
		    	<p>
		    		<b>End date:</b>
		    		<span id="staff_end_date_summary"></span>
		    	</p>
		    </div>
		    <div class="col-xs-6 col-sm-6 col-md-6" id="right-div">
		    	<p>
		    		<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
		    		<span id="location_summary"><?= $project->location ?></span>
		    	</p>
				<div id="skills_summary"></div>
		    </div>
		</div>

		<p>
			<label>Role:</label>
			<input type="text" name="role" value="General" id="staff_role">
		</p>
		<input type="hidden" value="" id="staff_id"/>

		<?php echo form_submit('submit', 'Add to Project', "id='staff-allocation-submit'");?>
		
		<button type="button" class="g-button" id="back-add">Go back</button>
	<?php echo form_close() ?>
</div>

<div id="staff-added-confirm" style="display: none">

	<h3>Staff added succesfully</h3>
	
	<i class="fa fa-check fa-5x green-c" aria-hidden="true"></i>

	<button class="g-button" id="confirm-add-staff">Add more</button>

	<button class="g-button" id="confirm-see-staff">See current staff</button>

</div>