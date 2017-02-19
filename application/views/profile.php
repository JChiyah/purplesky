<div id="userProfile">
	<div class="container">
		<div class="row">
			<!-- A row with 2 columns -->
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5" id="verticalLine">
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
	</div>

	<!--div class="container">
		<section id="experience">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<h1>Experiences</h1>
					<button id="experience-edit"><i class="fa fa-pencil" aria-hidden="true"></i>  Add</button>
				</div>
			</div>
			<hr>

			<div id="experience-set">
				<//?php echo form_open('User/experience_form', array('id' => 'experience-add')); ?>
					<div id="experience-msg"><//?php echo $message;?></div>
					<div class="container-box container-fluid" id="experience">

						<div class="row"><Main row begin>
							<div class="col-sm-12 col-md-6">
								<p>
									<label>Title:</label> <br>
									<//?php echo form_input($title,'',"required");?>
								</p>
							</div>
							<div class="row"><nested row begin>
								<div class="col-sm-12 col-md-6">
									<div class="row date-row">
										<div class="col-md-3">
											<p>
												<label>Start date:</label>
											</p>
										</div>
										<div class="col-md-9">
											<//?php echo form_input($start_date,'',"required");?>
										</div>
									</div>
									<div class="row date-row">
										<div class="col-md-3">
											<p>
												<label>End date:</label>
											</p>
										</div>
										<div class="col-md-9">
											<//?php echo form_input($end_date,'',"required");?>
										</div>
									</div>
								</div>
							</div><Nested row end>
						</div><Main row end>

						<!div class="row">
							<div class="col-sm-12 col-md-8">
								<p>
									<label>Description:</label> <br>
									<//?php echo form_textarea($description,'',"required");?>
								</p>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 col-md-6">
								<p>
									<label>Role:</label> <br>
									<//?php echo form_input($role,'',"required");?>
								</p>
							</div>
							<div class="col-sm-12 col-md-6">
								<//?php echo form_submit('submit', "Add experience","id='experience-submit'");?>
								<//?php echo form_close(); ?>
							</div>
						</div>

				</div>
			</div>
		</section>
	</div-->

	<div class="container">
		<section class="experience-box" id="experience">
			<div id="experience-set">
				<?php echo form_open('User/experience_form', array('id' => 'experience-add')); ?>
					<div id="experience-msg"><?php echo $message;?></div>

					<div class="row">
						<div class="col-sm-12 col-md-6">
							<p>
								<label>Title:</label> <br>
								<?php echo form_input($title,'',"required");?>
								<button id="experience-edit"><i class="fa fa-pencil" aria-hidden="true"></i>  Edit</button>
							</p>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="row date-row">
									<div class="col-md-3">
										<p>
											<label>Start date:</label>
										</p>
									</div>
									<div class="col-md-9">
										<?php echo form_input($start_date,'',"required");?>
									</div>
								</div>
								<div class="row date-row">
									<div class="col-md-3">
										<p>
											<label>End date:</label>
										</p>
									</div>
									<div class="col-md-9">
										<?php echo form_input($end_date,'',"required");?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-8">
							<p>
								<label>Description:</label> <br>
								<?php echo form_textarea($description,'',"required");?>
							</p>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-6">
							<p>
								<label>Role:</label> <br>
								<?php echo form_input($role,'',"required");?>
							</p>
						</div>
						<div class="col-sm-12 col-md-6">
							<?php echo form_submit('submit', "Add experience","id='experience-submit'");?>
							<?php echo form_close(); ?>
						</div>
					</div>
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
