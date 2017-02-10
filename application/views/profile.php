<div id="userProfile">
	<div class="container">
		<div class="row">
			<!-- A row with 2 columns -->
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
				<div id="verticalLine">
					<h1><?php echo $user->name; ?></h1>
					<p><?php echo $user->email; ?></p>
					<p><?php echo ucfirst( $user->group ); ?></p>
					<?php if(isset($user->location) && $user->location) { echo '<p>' . $user->location . '</p>'; } ?>
					<hr>
					<a class="g-button" style="width: 50%;" href="password">Change password</a>
				</div>
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
		               	if(isset($user_skills) && $user_skills) {
			               	foreach ($user_skills as $skill) {
			               		echo '<span class="skill-span">' . $skill->name . '<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>';
			               	}
			            }
	                ?>
				</div>
			</section>
		</div>

		<!--Exp section-->
		<div id="Experience">
			<h1>Experience</h1> <hr>

			<div class="container-box">

				<form class="" method="post">
					<div class="container-fluid">

							<div class="col-sm-12 col-md-6">
								<label>Project Title:</label>
								<input type="text" name="" value="" placeholder="Project Title">
							</div>
							<div class="col-sm-12 col-md-6">
							 	<div class="row date-row">
									<div class="col-md-3">
										<label>From:</label>
									</div>
									<div class="col-md-9">
										<input type="date" name="" value="">
									</div>
							 </div>
							<div class="row date-row">
								<div class="col-md-3">
									<label>To:</label>
								</div>
								<div class="col-md-9">
									<input type="date" name="" value="">
								</div>
							</div>
						</div>

						<!--div class="row"-->
							<div class="col-xs-12 col-md-12">
								<label>Description:</label>
								<textarea name="Description" rows="5" cols="100"></textarea>
							</div>
						<!--/div-->

						<!--div class="row"-->
							<div class="col-xs-12 col-md-6">
								<label>Skills Developed:</label>
								<input type="text" name="skillsDeveloped" value="Type skill here...">
								<a href="#">Add</a>
							</div>
							<div class="col-xs-12 col-md-6">
								<input type="submit" name="addExp" value="Add Experience">
							</div>
						<!--/div-->

					</div>
				</form>

			</div>
		</div>
		<p>No previous experiences to show here</p>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
</div>
