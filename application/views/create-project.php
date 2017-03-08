<div id="create-project">
	<h1>Create New Project</h1>

		<?php echo form_open('Project/create_project');?>

			<div id="infoMessage"><?php echo $message;?></div>
			<div class="container-fluid project-tab" id="create-1">
				<h2>Step 1: Project Details</h2>
				<hr>

				<section class="container-fluid content">
					<p>Please fill out all fields</p>
					<p>
						<label>Title:</label>
						<?php echo form_input($title, '', 'maxlength="90"');?>
					</p>
					<p>
						<label>Description:</label>
						<?php echo form_textarea($description, '', 'maxlength="250" rows="5"');?>
						<span>250 characters maximum</span>
					</p>
					<div class="row" id="project-dates">
						<p class="col-xs-12 col-sm-6 col-md-4">
							<label>From:</label>
							<?php echo form_date($start_date);?>
						</p>
						<p class="hidden-sm col-md-2"></p>
						<p class="col-xs-12 col-sm-6 col-md-4">
							<label>To:</label>
							<?php echo form_date($end_date);?>
						</p>
						<p class="hidden-sm col-md-2"></p>
					</div>
					<p>
						<label>Location:</label>
						<?php echo form_dropdown($location, array_merge(array( 0 => 'Select'), $locations));?>
					</p>
					<p id="priority-buttons">
						<b>Priority:</b><br/>
						<?php echo form_radio($normal_priority, '', true);?><?php echo form_label('Normal', 'normal');?>
						<?php echo form_radio($high_priority);?><?php echo form_label('High', 'high');?>
					</p>

					<button type="button" class="project-continue">Continue</button>

				</section>
			</div>
				
			<div class="container-fluid project-tab" id="create-2" style="display: none">
				<h2>Step 2: Project Allocation</h2>
				<hr>

				<section class="container-fluid content" id="resource-allocation">
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
					<div id="search-name">
						<label>Employee name:</label>
						<?php echo form_input($staff_name,'', 'maxlength="50"');?>
					</div>
					<button id="staff-allocation-search">Search</button>
				</section>

				<section class="row" id="resource-allocation-results">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<h2>Results</h2>
						<hr>
						<div id="results">

						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<h2>Added</h2>
						<hr>
						<div id="staff-added">

						</div>
					</div>
				</section>

				<button type="button" class="project-back">Back</button>

				<button type="button" class="project-continue">Continue</button>

			</div>

			<div class="container-fluid project-tab" id="create-3" style="display: none">
				<h2>Step 3: Project Summary</h2>
				<hr>

				<div class="container-fluid">
					
					<h1 id="title_summary">Test Project</h1>
					<h3><?php echo $manager; ?></h3>

					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<p>
					    		<b>Start date:</b>
					    		<span id="start_date_summary">10/10/2017</span>
					    	</p>
					    	<p>
					    		<b>End date:</b>
					    		<span id="end_date_summary">15/10/2017</span>
					    	</p>
					    </div>
					    <div class="col-xs-6 col-sm-6 col-md-6" id="right-div">
					    	<p>
					    		<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
					    		<span id="location_summary">Edinburgh</span>
					    	</p>
							<p>
					    		<span id="priority_summary">Normal</span>
					    		priority
					    	</p>
					    </div>
					</div>
					<p id="description_summary"></p>

					<div class="row" id="allocated-staff">
					  	<h2>Selected staff</h2>
					  	<hr>
						<div id="hidden-inputs">
							
						</div>
					</div>

					<button type="button" class="project-back">Back</button>

					<?php echo form_submit('submit', 'Submit', "id='create-project-submit'");?>

				</div>

			</div>

		<?php echo form_close(); ?>

</div>
<script type="text/javascript">var locations = <?php echo json_encode($locations, JSON_HEX_TAG); ?>;</script>
<script type="text/javascript" src="<?php echo base_url("assets/js/create-project.js"); ?>" ></script>
