<?php date_default_timezone_set('Europe/London'); ?>
<div id="home-page">
	<div class="container">
		<div class="home-container col-md-8 col-sm-12">
			<div class="content">
				<h2>Notifications</h2>
				<hr>
				<div id="notification-set">
					<?php 
						if(isset($activity) && $activity && sizeof($activity) > 0) {
							$first = FALSE;
							foreach($activity as $notification) {
								if(!$first) {
									$first = TRUE;
								} else {
									echo '<hr>';
								}
								echo '<div class="notification">
										<p class="col-xs-9">' . $notification->description . '</p>
										<p class="col-xs-3 not-date">' . time_elapsed_string($notification->at_date) . '</p>
									</div>';
							}
						} else {
							// Example data
							echo '<div class="notification">
									<p>Report for <a href="#">Security Reinforcement</a> project is due soon</p>
									<p class="not-date">An hour ago</p>
								</div>
								<hr>
								<div class="notification">
									<p>You were assigned to the project <a href="#">Analysis of Resources</a></p>
									<p class="not-date">23 Jan 2017 at 11:29</p>
								</div>
								<hr>
								<div class="notification">
									<p>Address updated successfully</p>
									<p class="not-date">18 Jan 2017 at 9:45</p>
								</div>';
						}
					?>
				</div>
			</div>
		</div>

		<div class="home-container col-md-4 col-sm-12">
			<div class="content">
				<h2>Welcome</h2>
				<div id="date">
					<hr>
					<span id="day"><?php echo date('l', time()); ?></span>
					<span id="month"><?php echo date('M Y', time()); ?></span>
					<span id="num-day"><?php echo date('jS', time()); ?></span>
					<span id="time"><?php echo date('H:i', time()); ?></span>
				</div>
			</div>
		</div>
		<div class="home-container col-md-4 col-sm-12">
			<div class="content">
				<h2>Current Projects</h2>
				<hr>
				<?php if (isset($current_projects) && $current_projects): ?>

					<?php foreach($current_projects as $project): ?>
						
						<a class="g-button" style="display: block;" href="dashboard/<?= $project->project_id ?>">
							<?= $project->title ?>
						</a>
					
					<?php endforeach ?>

				<?php else : ?>

					<p>No projects to show here</p>

				<?php endif ?>
			</div>
		</div>
		<div class="home-container col-md-8 col-sm-12">
			<div class="content">
				<h2>Recommended for you</h2>
				<hr>
				<?php if (isset($recommended_projects) && $recommended_projects): ?>
					<div class="row" id="recommended-projects">

					<?php foreach($recommended_projects as $project): ?>

						<a class="recommended-project col-md-4" href="dashboard/<?= $project->project_id ?>">
							<div>
								<h5><?= $project->title ?></h5>
								<hr>
								<p class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $project->location ?></p>
								<p class="manager"><?= $project->manager ?></p>
								<span class="date">
									<?= date('d/m/Y', strtotime($project->start_date)) ?> - 
									<?= date('j/n/Y', strtotime($project->end_date)) ?>
								</span>
							</div>
						</a>
					
					<?php endforeach ?>

					</div>
				<?php else : ?>

					<p>No projects to show here</p>

				<?php endif ?>
			</div>
		</div>
	</div>
</div>
