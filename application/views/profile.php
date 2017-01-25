<div id="userProfile">
	<div class="container">
		<div class="row">
			<!-- A row with 2 columns -->
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
				<h1><?php echo $user['name']; ?></h1>
				<p><?php echo $user['email']; ?></p>
				<p><?php echo $user['group']; ?></p>
				<p><?php echo $user['location']; ?></p>
				<hr>
				<a class="g-button" style="width: 50%;" href="password">Change password</a>
			</div>
			<!--Skill section-->
			<section id="skills" class="col-xs-12 col-sm-6 col-md-6 col-lg-7">
				<div class="row">
					<h1>Skills</h1>
					<button id="skill-edit"><i class="fa fa-pencil" aria-hidden="true"></i>  Edit</button>
				</div>
				<hr>
				<div id="skill-set">
					<?php echo form_open('', array('id' => 'skill-add')); ?>
						<?php echo lang('skill_edit_label', 'skills');?>
	                  	<?php echo form_dropdown($skill_select, $skills);?>
	                  	<?php echo form_submit('submit', lang('add_label'), "class='submit'");?>
               		<?php echo form_close(); ?>

               <?php 
               	if(isset($user['skills']) && $user['skills']) {
	               	foreach ($user['skills'] as $skill) {
	               		echo '<span class="skill-span">' . $skill->name . '<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>';
	               	}
	            }
               ?>
				</div>

			</section>
		</div>

		<!--Exp section-->
		<!--TODO: come back later and nest the To and FROM date in a single nested row under title to clean up-->
		<h1>Experience</h1>
		<hr>
		<!--
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
		</div>-->
		<!--TODO:: ask to find out how to implement this exact section, below is just a placeholder
		add a div class to display top and bottom block lines, dont use hr-->
		<p>No previous experiences to show here</p>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</div>
