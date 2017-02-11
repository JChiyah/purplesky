<div id="userProfile">
	<div class="container">
		<div class="row">
			<!-- A row with 2 columns -->
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
				<h1><?php echo $user->name; ?></h1>
				<p><?php echo $user->email; ?></p>
				<p><?php echo ucfirst( $user->group ); ?></p>
				<?php if(isset($user->location) && $user->location) { echo '<p>' . $user->location . '</p>'; } ?>
				<hr>
				<a class="g-button" style="width: 50%;" href="change-password">Change password</a>
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
						<?php echo form_submit('submit', lang('add_label'), "id='skill-submit'");?>
					<?php echo form_close(); ?>

					<?php 
						if(isset($user_skills) && $user_skills) {
							foreach ($user_skills as $skill) {
								echo '<span class="skill-span">' . $skill->name . '<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>';
							}
						} else {
							echo '<p>No skills to show here</p>';
						}
					?>
				</div>
			</section>
		</div>
		
		<section id="experience">
			<div class="row">
				<h1>Experiences</h1>
				<button id="experience-edit"><i class="fa fa-pencil" aria-hidden="true"></i>  Edit</button>
			</div>
			<hr>
			<div id="experience-set">
				<?php echo form_open('User/experience_form', array('id' => 'experience-add')); ?>
					<div id="experience-msg"><?php echo $message;?></div>
					<p>
						<label>Start date:</label>
						<?php echo form_input($start_date,'',"required");?>
					</p>
					<p>
						<label>End date:</label>
						<?php echo form_input($end_date,'',"required");?>
					</p>
					<p>
						<label>Title:</label>
						<?php echo form_input($title,'',"required");?>
					</p>
					<p>
						<label>Description:</label>
						<?php echo form_textarea($description,'',"required");?>
					</p>
					<p>
						<label>Role:</label>
						<?php echo form_input($role,'',"required");?>
					</p>
					<?php echo form_submit('submit', "Add experience","id='experience-submit'");?>
				<?php echo form_close(); ?>
				<?php 
					if(isset($user_experiences) && $user_experiences) {
						foreach ($user_experiences as $experience) {
							echo '<div class="experience-box">
									<h2>' . $experience->role . '</h2>
									<p><strong>' 
										. date_format(date_create($experience->start_date), 'j M Y') . '</strong> until <strong>' 
										. date_format(date_create($experience->end_date), 'j M Y') . '</strong> at ';
									if($experience->project_id) {
										echo '<a href="#">' . $experience->title . '</a>';
									} else {
										echo $experience->title;
									}
									echo 
									'</p>
									<p>'
										. $experience->description .
									'</p>
								</div>';
						}
					} else {
						echo '<p>No previous experiences to show here</p>';
					}
				?>
			</div>
		</section>
	</div>
</div>
