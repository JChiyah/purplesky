<?php global $user_group; ?>
<div id="project-dashboard">
	
	<h1><b><?= $project->title ?></b></h1>
	<h2><?= $project->manager ?></h2>

	<div id="project-view"> 

		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6">
				<p><b>Start date:</b> <?= $project->start_date ?></p>
				<p><b>End date:</b> <?= $project->end_date ?></p>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6" id="right-div">
				<p><?= ucfirst($project->priority) ?> priority</p>
				<p><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $project->location ?></p>
			</div>
		</div>
		<p><?= $project->description ?></p>
		<hr>
		<h2>Notifications</h2>
			<?php if(isset($dashboard) && $dashboard && sizeof($dashboard) > 0) :
				foreach($dashboard as $notification) : ?>

					<div class="notification">
						<p class="col-xs-10"><?= $notification->description ?></p>
						<p class="col-xs-2 not-date"><?= time_elapsed_string($notification->date) ?></p>
					</div>
					<hr>

				<?php endforeach ?>

			<?php else : ?>
				<p>No notifications to show here</p>
			<?php endif ?>

		<?php if ($is_manager) : ?>
			<form action="" method="post">
				<input type="text" name="" value="" placeholder="Enter a new notification">
				<input type="submit" name="" value="Add notification" id="">
			</form>
			<hr>
		
		<?php endif ?>

	</div>

	<div class="projectstaff">

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

	</div>
	

</div>
