<div id="project-dashboard">
	<div class="container-fluid">
		<div class="row">

			<section class="col-xs-12 col-sm-5 col-md-5" id="project-title">
				<div>
					<h1><?= $project->title ?></h1>
					<h2><?= $project->manager ?></h2>
				</div>
				<hr>
				<?php if($is_manager) : ?>
					<a href="<?= site_url('project-management') ?>/<?= $project->project_id ?>" class="g-button">Manage Project</a>
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
							<p><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $project->location ?></p>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6" id="right-div">
							<p><?= ucfirst($project->status) ?> <span class="circle <?= $status ?>"></span></p>
							<p><?= ucfirst($project->priority) ?> priority</p>
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

	<section class="container-fluid" id="projectstaff">

		<?php if(isset($staff) && $staff) : ?>

			<table>
				<thead>
				<tr>
					<th class="tablename">Staff</th>
					<th class="tablerole">Role</th>
					<th class="tabledate">From</th>
					<th class="tabledate">To</th>

					<?php if ($is_manager) : ?>
						<th class="tablepay">Daily Rate</th>		
					<?php endif ?>
				</tr>
				</thead>

				<tbody>

				<?php foreach ($staff as $employee) : ?>
					
					<tr>
						<td><?= $employee->name ?></td>
						<td><?= $employee->role ?></td>
						<td><?= date('d/m/Y', strtotime($employee->start_date)) ?></td>
						<td><?= date('d/m/Y', strtotime($employee->end_date)) ?></td>
						
						<?php if ($is_manager) : ?>
							<td class="tablepay">£<?= $employee->pay_rate ?></td>
						<?php endif ?>
					</tr>

				<?php endforeach ?>
				</tbody>
			
			</table>

		<?php else : ?>

			<p>No staff working in the project</p>

		<?php endif ?>

		<hr>
		
		<?php if ($is_manager) : ?>
			<p id="budget"><b>Total budget:</b> £<?= $project->budget ?></p>		
		<?php endif ?>

	</section>
	

</div>
