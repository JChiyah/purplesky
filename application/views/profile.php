<div id="profile">
	<div class="container">
		<div class="row">
			<!-- A row with 2 columns -->
			<div class="col-xs-12 col-sm-5 col-md-5" id="personal-details">
				<div>
					<h1><?php echo $user->name; ?></h1>
					<p><?php echo $user->email; ?></p>
					<p id="staff-type"><?php echo ucwords( $user->group ); ?></p>
					<?php if(isset($user->location) && $user->location) { echo '<p><i class="fa fa-globe fa-lg" aria-hidden="true"></i> ' . $user->location . '</p>'; } ?>
				</div>
				<hr>
				<a class="g-button" style="width: 50%;" href="change-password">Change password</a>
				<?php if(!$only_admin) : ?><button class="g-button" id="add-skill">Add Skills</button><?php endif ?>
				<?php if(!$only_admin) : ?><button class="g-button" id="add-experience">Add Experience</button><?php endif ?>
			</div>

			<!--Skill section-->
			<section id="skills" class="col-xs-12 col-sm-7 col-md-7">
				<div class="row">
					<h1>Skills</h1>
					<?php if(!$only_admin) : ?>
					<button class="edit-button" id="skill-edit"><i class="fa fa-pencil" aria-hidden="true"></i>  Edit</button><?php endif ?>
				</div>
				<hr>
				<?php if(!$only_admin) : ?>
					<div id="skill-set">
						<?php echo form_open('', array('id' => 'add-skill-form')); ?>
							<label>Select a skill to add</label>
							<?php echo form_dropdown($skill_select, $skills);?>
							<?php echo form_submit('submit', lang('add_label'), "id='skill-submit'");?>
							<p>You can also delete skills by clicking on the cross</p>
						<?php echo form_close(); ?>
						
						<div id="user-skills">
							<?php $this->load->view('displays/user-skills.php', $user_skills); ?>
						</div>
						<div id="user-undo-skills">

						</div>
					</div>
				<?php else : ?>
					<p>HR Admins cannot add skills</p>
				<?php endif ?>
			</section>
		</div>
	</div>

	<div class="container">
		<section id="experience">
			<div class="row">
				<div class="col-sm-12 col-md-12 row" id="exp-row">
					<h1>Experiences</h1>
					<?php if(!$only_admin) : ?>
					<button class="edit-button" id="experience-edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button><?php endif ?>
				</div>
			</div>
			<hr>
			<?php if(!$only_admin) : ?>

				<?php echo form_open('User/experience_form', array('id' => 'add-experience-form', 'class' => 'container-fluid')); ?>

					<h2>Add Experience</h2>
					<hr>

					<div class="row">
						<div class="col-sm-12 col-md-8">
							<p>
								<label>Role:</label>
								<?php echo form_input($role,'','required maxlength="90"');?>
							</p>
							<p>
								<label>Company/institution:</label>
								<?php echo form_input($title,'','required maxlength="90"');?>
							</p>
						</div>
						<div class="col-sm-12 col-md-4">
							<p>
								<label>Start date:</label>
								<?php echo form_input($start_date,'','required');?>
							</p>
							<p>
								<label>End date:</label>								
								<?php echo form_input($end_date,'','required');?>
							</p>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-8">
							<label>Description:</label>
							<?php echo form_textarea($description,'','required maxlength="250" rows="4"');?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-8">
							<label>Skills learned/used:</label>
							<?php echo form_dropdown(array('id' => 'experience-skills'), array_merge(array( 0 => 'Select'), $skills));?>
							<button type="button" class="g-button" id="clear-skills">Clear All</button>
							<div id="selected-skills"></div>
						</div>
					</div>
					<div class="row">
						<div class="hidden-xs col-sm-8"></div>
						<?php echo form_submit('submit', "Add experience","class='col-xs-12 col-sm-4' id='experience-submit'");?>
					</div>
					<p id="experience-msg"><?php echo $message;?></p>
				<?php echo form_close(); ?>
			<?php endif ?>


			<div id="experience-set">

				<div id="experiences">
					
					<?php if(!$only_admin) : ?>
						<?php $this->load->view('displays/user-experiences.php', $user_experiences); ?>
					<?php else : ?>
						<p>HR Admins do not have experiences to show here</p>
					<?php endif ?>
				</div>

			</div>
		</section>

	</div>
</div>

<script type="text/javascript" src="<?php echo base_url("assets/js/profile.js"); ?>" ></script>
