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
