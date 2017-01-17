<div id="userProfile">
	<div class="container">
		<div class="row">
			<!-- A row with 2 columns -->
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
				<h1>Employee</h1>
				<!--label ? double check should these be labels or text fields? or do they turn into text fields after edit-->
				<p>Employee email</P>
				<p>account role</p>
				<p>Location</p>
				<hr>
				<form class="" action="index.html" method="post">
					<input type="submit" name="changePassword" value="Change Password">
				</form>
			</div>
			<!--Skill section-->
			<section id="skills" class="col-xs-12 col-sm-6 col-md-6 col-lg-7">
				<h1>Skills</h1>
				<button id="skill-edit"><i class="fa fa-pencil" aria-hidden="true"></i>  Edit</button>
				<hr>
				<div id="skill-set">
					<?php echo form_open('', array('id' => 'skill-add')); ?>
						<?php echo lang('skill_edit_label', 'skills');?>
						<p>
	                  <?php echo form_dropdown($skill_select, array('CSS','Java','Python','HTML'), array(0));?>
	                  <?php echo form_submit('submit', lang('add_label'), "class='submit'");?>
						</p>

               <?php echo form_close();?>

					<span class="skill-span">CSS<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>
					<span class="skill-span">HTML<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>
					<span class="skill-span">Java<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>
					<span class="skill-span">Microsoft<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>
					<span class="skill-span">Python<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>
					<span class="skill-span">SML<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>
				</div>

			</section>
		</div>

		<!--Exp section-->
		<!--TODO: come back later and nest the To and FROM date in a single nested row under title to clean up-->
		<h1>Experience</h1>
		<hr>
		<div id="UPContainer">
			<form class="" action="index.html" method="post">
				<div class="row">
					<div class="col-xs-12 col-md-8">
						<label>Title:</label><br>
						<input type="text" name="Title" value="">
					</div>
					<div class="col-xs-12 col-md-4">
						<label>From:</label>
						<input type="text" name="From" value="DD/MM/YYYY">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-8">
					</div>
					<div class="col-xs-12 col-md-4">
						<label>To: </label>
							<input type="text" name="From" value="DD/MM/YYYY">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Description:</label><br>
						<textarea name="Description" rows="5" cols="100"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<label>Skills Developed:</label><br>
						<input type="text" name="skillsDeveloped" value="Type skill here...">
					</div>
					<div class="col-xs-12 col-md-2">
						<a href="#">Add</a>
					</div>
					<div class="col-xs-12 col-md-4">
						<input type="submit" name="addExp" value="Add Experience">
					</div>
				</div>
			</form>
		</div>
		<!--TODO:: ask to find out how to implement this exact section, below is just a placeholder
		add a div class to display top and bottom block lines, dont use hr-->
		<hr>
		<h1>Title of Experience</h1>
		<label>Description...</label>
		<label>Skills developed</label>
		<hr>
	</div>
</div>
