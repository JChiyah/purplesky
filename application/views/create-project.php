<div id="newProject">
	<div class="container">
		<h1>Create new Project</h1>
		<div class="container">
			<?php echo form_open('Project/create_project');?>
			<div id="infoMessage"><?php echo $message;?></div>
			<div class="container project-tab" id="create-1">
				<h2>Step 1: Project Details</h2>
				<hr>
				<p>Please fill out all fields.</p>

				<p>
					<label>Title:</label>
					<?php echo form_input($title, '', 'placeholder="Project title"');?>
				</p>
				<p>
					<label>Description:</label>
					<?php echo form_textarea($description, '', 'placeholder="Project description"');?>
				</p>
				<p>
					<label>From:</label>
					<?php echo form_date($start_date);?>
				</p>
				<p>
					<label>To:</label>
					<?php echo form_date($end_date);?>
				</p>
				<p>
					<label>Location:</label>
					<?php echo form_dropdown($location, array_merge(array( 0 => 'Select'), $locations));?>
				</p>
				<p>
					<label>Priority:</label>
					<?php echo form_radio($normal_priority, '', true);?><?php echo form_label('Normal', 'normal');?>
					<?php echo form_radio($high_priority);?><?php echo form_label('High', 'high');?>
				</p>
			</div>
				
			<div class="container project-tab" id="create-2" style="display: none">
				<h2>Step 2: Project Allocation</h2>
				<hr>
				<section id="resource-allocation">
					<p>You can search staff for this project by skills or by name</p>
					<p>
						<?php echo form_dropdown($skill_select, array_merge(array( 0 => 'Select'), $skills));?>
						<button type="button" id="clear-skills">Clear</button>
						<div id="selected-skills"></div>
					</p>
					<p>
						<?php echo form_date($staff_start_date);?>
					</p>
					<p>
						<?php echo form_date($staff_end_date);?>
					</p>
					<p>
						<label>Employee name:</label>
						<?php echo form_input($staff_name);?>
					</p>
					<button id="staff-allocation-search">Search</button>
				</section>

				<section id="resource-allocation-results">
					<div id="results">

					</div>
					<div id="staff-added">
						<h1>Added</h1>
					</div>
				<section>
			</div>

			<div class="container project-tab" id="create-3" style="display: none">
				<h2>Step 3: Project Summary</h2>
				<hr>
				<h1 id="title_summary"></h1>
				<h3><?php echo $manager; ?></h3>
				<div class="row">
				  	<div class="col-xs-12 col-sm-6 col-md-6">
				    	<label>Start date:</label>
				    	<p id="start_date_summary"></p>
				  	</div>
				  	<div class="col-xs-12 col-sm-6 col-md-6">
				    	<label>Priority:</label>
				    	<p id="priority_summary">Normal</p>
				  	</div>
				</div>
				<div class="row"> <!--end and location-->
					<div class="col-xs-12 col-sm-6 col-md-6">
				    	<label>End date:</label>
				    	<p id="end_date_summary"></p>
				  	</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
					    <label>Location:</label>
					    <p id="location_summary"></p>
					</div>
				</div>
				<p></p>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
					    <p id="description_summary"></p>
					</div>
				</div>
				<div class="row" id="allocated-staff">
				  	<h2>Staff</h2>
					<div id="hidden-inputs"></div>
				</div>

				<?php echo form_submit('submit', 'Submit', "id='create-project-submit'");?>

			</div>

			<?php echo form_close(); ?>

			<button id="project-continue">Continue</button>
		</div>
	</div>
</div>
<script type="text/javascript">var locations = <?php echo json_encode($locations, JSON_HEX_TAG); ?>;</script>
<script type="text/javascript" src="<?php echo base_url("assets/js/create-project.js"); ?>" ></script>
