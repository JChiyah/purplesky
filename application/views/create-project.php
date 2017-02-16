<div id="newProject">
	<div class="container">
		<h1>Create new Project</h1>
		<div class="container">
			<button id="project-continue">Continue</button>
			<?php echo form_open("Project/create_project");?>
			<div id="infoMessage"><?php echo $message;?></div>
			<div class="container project-tab" id="create-1">
				<h2>Step 1: Project Details</h2>
				<hr>
				<p>Please fill out all fields.</p>
				<?php echo form_submit('submit', 'Submit', "id='create-project-submit'");?>

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
				<!--<div class="col-xs-12 col-sm-6 col-md-12" id="NPcontainer">
					<p>Please fill out at least one of the required fields marked with an asterisk</p>
					<form class="" action="index.html" method="post">
						<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-5">
								<label>*Skills:</label> <br>
								<input type="text" name="skills" value="Type skills here..." required>
								<p></p>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-1">
								<a href="#">Add</a>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-6">
								<label>Employee Name:</label> <br>
								<input type="text" name="employeeName" value="" required>
								<p></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-6">
								<label>*Are employees required to be on locations?</label>
								<p></p>
								<input type="radio" name="onSite" value="yes" checked>Yes
								<input type="radio" name="onSite" value="no">no
								<p></p>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-6">
								<label>Max. Daily Rate:</label><br>
								<select name="payRate">
									<option value="500">£500</option>
									<option value="400">£400</option>
								</select>
								<p></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-6">
								<label>*From:</label>
								<input type="date" name="fromDate" value="DD/MM/YYYY">
								<p></p>
								<label>*To:</label>
								<input type="date" name="toDate" value="DD/MM/YYYY">
								<p></p>
								</div>
							<div class="col-xs-12 col-sm-3 col-md-6">
								<input type="submit" name="submit" value="Submit">
							</div>
						</div> 
					</form>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-6">
						Results:
						Order by:
						<select name="orderBy">
							<option value="dailyRate">Daily Rate</option>
							<option value="location">Locations</option>
						</select>
						<hr>
						Employee A: <hr>
						Employee B: <hr>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-6">
						Added: <hr>
						Emplyee A: <hr>
						Employee B: <hr>
					</div>
					<input type="submit" name="Load" value="Load more results">
				</div>-->
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
				<div class="row">
				  	<div class="col-xs-12 col-sm-12 col-md-12">
					    <p>Slected staff  From:  To: Daily Rate:</p>
					    <div class="row">
					      <div class="col-xs-12 col-sm-12 col-md-12">
					        test1
					      </div>
					      <div class="col-xs-12 col-sm-12 col-md-12">
					        Test2
					      </div>
					      <div class="col-xs-12 col-sm-12 col-md-12">
					        Test3
					      </div>
					      <div class="col-xs-12 col-sm-12 col-md-12">
					        test4
					      </div>
					    </div>
						
					</div>
				</div>
			</div>

			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script type="text/javascript">var locations = <?php echo json_encode($locations, JSON_HEX_TAG); ?>;</script>
<script type="text/javascript" src="<?php echo base_url("assets/js/create-project.js"); ?>" ></script>
