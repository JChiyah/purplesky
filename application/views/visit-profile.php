<div id="profile">
	<div class="container">
		<div class="row">

			<section class="col-xs-12 col-sm-5 col-md-5" id="personal-details">
				<div>
					<h1><?php echo $user->name; ?></h1>
					<p><?php echo $user->email; ?></p>
					<p id="staff-type"><?php echo ucwords( $user->group ); ?></p>
					<?php if(isset($user->location) && $user->location) { echo '<p><i class="fa fa-globe fa-lg" aria-hidden="true"></i> ' . $user->location . '</p>'; } ?>
				</div>
				<hr>
			</section>

			<!--Skill section-->
			<section id="skills" class="col-xs-12 col-sm-7 col-md-7">
				<div class="row">
					<h1>Skills</h1>
				</div>
				<hr>

				<div id="skill-set">
					
					<div id="user-skills">
						<?php $this->load->view('displays/user-skills.php', $user_skills); ?>
					</div>
				</div>
			</section>
		</div>
	</div>

	<div class="container">
		<section id="experience">
			<div class="row">

				<div class="col-sm-12 col-md-12 row" id="exp-row">
					<h1>Experiences</h1>
				</div>
			</div>
			<hr>

			<div id="experience-set">

				<div id="experiences">
					<?php $this->load->view('displays/user-experiences.php', $user_experiences); ?>
				</div>

			</div>
		</section>

	</div>
</div>
