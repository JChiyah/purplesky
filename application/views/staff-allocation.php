<section class="container-fluid" id="staff-allocation">

	<h1>Staff Allocation Panel</h1>
	<hr>

	<p>Here you can edit the project details, manage staff and other various tasks.</p>

	<div class="container-fluid row">
		
		<div class="col-xs-12 col-sm-2 col-md-2" id="left-bar">
			<ul>
				<li><button class="active" id="staff">Project Staff</button></li>
				<li><button id="tasks">Project Tasks</button></li>
				<li><button id="task">Add Task</button></li>
				<li><button id="add">Add Staff</button></li>
				<li><button id="edit">Edit Staff</button></li>
				<li><button id="remove">Remove Staff</button></li>
			</ul>
		</div>

		<div class="container-fluid col-xs-12 col-sm-10 col-md-10">

			<div class="container-fluid tab" id="see-staff">
				<h2>Project Staff</h2>
				<hr>
				<div id="project-staff">

				</div>
			</div>

			<div class="container-fluid tab" id="see-tasks">
				<h2>Project Tasks</h2>
				<hr>
				<div id="project-tasks">

				</div>
			</div>

			<div class="container-fluid tab" id="add-task">
				<h2>Add Task</h2>
				<hr>
				<div id="add-project-task">

				</div>
			</div>

			<div class="container-fluid tab" id="add-staff" style="display: none">
				<h2>Add Staff</h2>
				<hr>
				<?php echo form_open('', array('id' => 'search-staff-form')) ?>
					<p>You can search staff for this project by skills or by name</p>
					<div>
						<label>Skills:</label>
						<?php echo form_dropdown($skill_select, array_merge(array( 0 => 'Select'), $skills));?>
						<button type="button" id="clear-skills">Clear</button>
						<div id="selected-skills"></div>
					</div>
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
					<button type="button" id="search-name-toggle">Search by name</button>
					<div id="search-name" style="display: none">
						<label>Employee name:</label>
						<?php echo form_input($staff_name,'', 'maxlength="50"');?>
					</div>
					<input type="hidden" value="<?= $current_location ?>" id="staff-location"/>
					<input type="hidden" value="<?= $project->project_id ?>" id="project_id"/>

					<?php echo form_submit('submit', 'Search', "id='staff-allocation-search'");?>
				<?php echo form_close() ?>
				
				<div id="search-results">
					<h2>Results</h2>
					<hr>
					<div id="results">

					</div>
				</div>
				
				<?php echo form_open('', array('id' => 'allocate-staff-form', 'style' => 'display: none')) ?>

					<p>You are adding this employee to the project</p>
					
					<h3 id="staff_name_summary"></h3>
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<p>
					    		<b>Start date:</b>
					    		<span id="start_date_summary"></span>
					    	</p>
					    	<p>
					    		<b>End date:</b>
					    		<span id="end_date_summary"></span>
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
				
				<?php echo form_close() ?>

				<div id="staff-added-confirm" style="display: none">

					<h3>Staff added succesfully</h3>
					
					<i class="fa fa-check fa-5x" aria-hidden="true"></i>

					<button id="confirm-add">Add more</button>

					<button id="confirm-see">See current staff</button>

				</div>

			</div>

			<div class="container-fluid tab" id="edit-staff" style="display: none">
				<p>lol</p>
			</div>

			<div class="container-fluid tab" id="remove-staff" style="display: none">
				<h2>Remove Staff</h2>
				<hr>

				<p>Here you can remove staff working on the project. If the staff is working in a selected task, they will also be removed from it automatically.</p>
				
				<div id="remove-staff-list">

				</div>

			</div>

		</div>

	</div>

</section>

<script type="text/javascript" src="<?php echo base_url("assets/js/staff-allocation.js"); ?>"></script>
