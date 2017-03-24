<div id="project-dashboard">
	<div class="container-fluid">
		<div class="row">

			<section class="col-xs-12 col-sm-5 col-md-5" id="project-title">
				<div>
					<h1><?= $project->title ?></h1>
					<h2><?= $project->manager ?></h2>
					<?php if ($is_manager) : ?>
						<h3><b>Total budget:</b> £<?= $project->budget ?></h3>
					<?php endif ?>
				</div>
				<hr>
				<?php if($is_manager) : ?>
					<a href="<?= site_url('project-management') ?>/<?= $project->project_id ?>" class="g-button">Manage Project</a>
				<?php elseif(!$is_staff) : ?>
					<a href="#" class="g-button">Apply</a>
				<?php endif ?>
			</section>

			<section class="col-xs-12 col-sm-7 col-md-7" id="project-details">
				<h2>Project Details</h2>
				<hr>
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<p><b>Start date:</b> <?= date('d/m/Y', strtotime($project->start_date)) ?></p>
							<p><b>End date:</b> <?= date('d/m/Y', strtotime($project->end_date)) ?></p>
							<p><?= ucfirst($project->status) ?> <span class="circle <?= $status ?>"></span></p>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6" id="right-div">
							<p><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $project->location ?></p>
							<p><?php echo ucfirst($project->priority);
								if($project->priority != 'confidential')
									echo ' priority';
								?></p>
						</div>
					</div>
					<p class="row"><?= $project->description ?></p>
				</div>
			</section>
		</div>
	</div>

	<section class="container-fluid" id="project-notifications">
		<h2>Notifications</h2>
		<hr>

		<div id="dashboard_entries">

			<?php $this->load->view('displays/project-dashboard-entries.php', $dashboard_entries); ?>

		</div>

	</section>

	<section class="container-fluid" id="project-staff">
		<h2>Staff</h2>
		<hr>

		<?php if(isset($staff) && $staff) : ?>
			<?php if(count(array_intersect(array(1, 2), $_SESSION['access_level'])) > 0 || $is_manager) {
				echo '<p>You can click on the employee to see their profile</p>';
			} ?>
			
			<div class="container-fluid" id="all-staff">

				<div class="row" id="staff-head">
					<p class="col-xs-6">Staff</p>
					<p class="col-xs-3">From</p>
					<p class="col-xs-3">To</p>
				</div>

				<?php foreach ($staff as $employee) : ?>

				<a <?php echo count(array_intersect(array(1, 2), $_SESSION['access_level'])) > 0 || $is_manager ? 'href="' . site_url(strtolower(str_replace(' ','.',$employee->name))) . '"' : '' ?> class="row staff">
					<div class="col-xs-6">
						<h4><?= $employee->name ?></h4>
						<p><?= $employee->location ?>/<?= $employee->role ?>
							<?php foreach($employee->skills as $skill) : ?>
								<span class="skill-span"><?= $skill ?></span>
							<?php endforeach ?>
						</p>
					</div>
					<p class="col-xs-3"><?= date('d/m/Y', strtotime($employee->start_date)) ?></p>
					<p class="col-xs-3"><?= date('d/m/Y', strtotime($employee->end_date)) ?></p>
				</a>

				<?php endforeach ?>

			</div>

		<?php else : ?>

			<p>No staff working in the project</p>

		<?php endif ?>

	</section>
	

</div>
