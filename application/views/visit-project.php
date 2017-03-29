<div id="project-dashboard">
	<a class="visit-link" href="dashboard/<?= $project->project_id ?>">Visit project page <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
	<div class="row">
	<div class="container-fluid">

			<section class="col-xs-12 col-sm-5 col-md-5" id="project-title">
				<div>
					<h1><?= $project->title ?></h1>
					<h2><?= $project->manager ?></h2>
					<?php if ($is_manager) : ?>
						<h3><b>Total budget:</b> £<?= $project->budget ?></h3>
					<?php endif ?>
				</div>
				<hr>
				<?php if(!$is_staff && !$is_manager) : ?>
					<button class="g-button apply-to-project" id="apply-<?= $project->project_id ?>">Apply</button>
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
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6" id="right-div">
							<p><?= ucfirst($project->status) ?> <span class="circle <?= $status ?>"></span></p>
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

			<?php $this->load->view('displays/project-dashboard-entries.php'); ?>

		</div>

	</section>

</div>
