<?php $access = count(array_intersect(array(1, 2), $_SESSION['access_level'])); ?> 
<div id="search">
	<h1 id="search-title">Search for Projects</h1>

	<div class="container-box">
		<?php if($access != 0): ?>
		<div class="row" id="search-type">
			<button class="col-sm-6 active" id="search-projects">Search projects</button>
			<button class="col-sm-6" id="search-users">Search users</button>
		</div>
		<?php endif ?>
		<section id="project-search">
			<?php echo $access == 0 ? '<p>Search for any current or future projects within the organisation</p>' : '<p>Search and apply for any current or future projects within the organisation</p>'; ?>
         	
         	<?php echo form_open();?>
				<?php echo form_input($keyword, '', 'placeholder="Enter description keyword, project title or manager name"');?>
				<?php echo form_submit('submit', 'Search', "id='search-submit'");?>

				<div id="advanced-search">
					<hr>
					<h2>Advanced Search</h2>
					<p>You can fill in as many details as you want to filter projects</p>
					<div class="container-fluid">
						<div class="col-sm-12 col-md-6">
							<div class="row date-row">
								<div class="col-md-3">
									<label>From:</label>
								</div>
								<div class="col-md-9">
									<?php echo form_date($start_date);?>
								</div>
							</div>
							<div class="row date-row">
								<div class="col-md-3">
									<label>To:</label>
								</div>
								<div class="col-md-9">
									<?php echo form_date($end_date);?>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<p>
								<label>Location:</label> <br>
								<?php echo form_dropdown($location, array_merge(array( 0 => 'Any'), $locations), 0);?>
							</p>
						</div>
					</div>
				</div>

			<?php echo form_close();?>
		</section>

		<?php if($access != 0): ?>
		<section id="user-search">
			<p>Search users and see their profile</p>
         	
         	<?php echo form_open();?>
				<?php echo form_input($staff_name);?>
				<?php echo form_submit('submit', 'Search', "id='user-search-submit'");?>

				<div id="user-advanced-search">
					<hr>
					<h2>Advanced Search</h2>
					<p>You can fill in as many details as you want to filter users</p>
					<div class="container-fluid">
						<div class="col-sm-12 col-md-6">
							<div class="row date-row">
								<div class="col-md-3">
									<label>From:</label>
								</div>
								<div class="col-md-9">
									<?php echo form_date($staff_start_date);?>
								</div>
							</div>
							<div class="row date-row">
								<div class="col-md-3">
									<label>To:</label>
								</div>
								<div class="col-md-9">
									<?php echo form_date($staff_end_date);?>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="row date-row">
								<div class="col-md-3">
									<label>Location:</label>
								</div>
								<div class="col-md-9">
									<?php echo form_dropdown($staff_location, array_merge(array( 0 => 'Any'), $locations), 0);?>
								</div>
							</div>
							<div class="row date-row">
								<div class="col-md-3">
									<label>Skills:</label>
								</div>
								<div class="col-md-9">
									<?php echo form_dropdown($skill_select, array_merge(array( 0 => 'Select'), $skills));?>
									<button type="button" id="clear-skills">Clear</button>
								</div>
							</div>
							<div id="selected-skills"></div>
						</div>
					</div>
				</div>

			<?php echo form_close();?>
		</section>
		<?php endif ?>

		<button id="search-toggle"><i class="fa fa-caret-down fa-2x" aria-hidden="true"></i></button>
	</div>

	<div id="search-popup" style="display: none">
		
	</div>

	<section id="search-results">
		<h2>Results</h2>
		<hr>
		<div id="results">
			
		</div>
		<div id="user-results">
			
		</div>
	</section>

	<button class="scroll-button" id="scroll-up"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></button>

</div>

<script type="text/javascript" src="<?php echo base_url("assets/js/search.js"); ?>" ></script>
