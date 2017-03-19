<section class="container-fluid" id="project-management-panel">

	<h1>Project Management Panel</h1>
	<hr>

	<p>Here you can edit the project details, manage staff and other various tasks.</p>

	<div class="container-fluid row">
		
		<div class="col-md-2" id="left-bar">
			<ul>
				<li><button <?php echo isset($action) && $action == 'edit' ? '' : 'class="active"' ?> id="staff">Project Staff</button></li>
				<li><button id="tasks">Project Tasks</button></li>
				<li><button id="notification">Add Notification</button></li>
				<li><button <?php echo isset($action) && $action == 'edit' ? 'class="active"' : '' ?> id="edit">Edit Project</button></li>
				<li><a href="<?= site_url('project-management') ?>/<?= $project->project_id ?>/staff-allocation">Allocate staff</a></li>
				<li><button id="status">Change Project Status</button></li>
				<li><button id="applications">Applications</button></li>
			</ul>
		</div>

		<div class="container-fluid col-md-10">
			
			<div class="container-fluid tab" id="see-staff" <?php echo (isset($action) && $action) ? 'style="display: none"' : ''?>>
				<h2>Project Staff</h2>
				<hr>
				<div id="project-staff">

				</div>
			</div>

			<div class="container-fluid tab" id="dashboard-entry" style="display: none">
				<p>Here you can add a new notification to the project dashboard that everyone can see.<br/>
				Staff working in the project will also be notified</p>

				<form method="post" id="new-entry">
					<input type="text" name="" id="entry-description" placeholder="Enter a new notification" maxlength="250">
					<input type="submit" name="" value="Add notification" id="dashboard-entry-submit">
					<input type="hidden" name="" value="<?= $project->project_id ?>" id="project_id">
				</form>
				
				<div id="another-entry" style="display: none">
					<span class="confirm-msg">New entry added!</span>
					<i class="fa fa-check fa-5x green-c" aria-hidden="true"></i>					
					<button>Add another entry</button>
				</div>
			</div>

			<div class="container-fluid tab" id="edit-project" <?php echo isset($action) && $action == 'edit' ? '' : 'style="display: none"' ?>>
				
				<?php $this->load->view('project-panel/edit-project.php'); ?>

			</div>

			<div class="container-fluid tab" id="project-status" style="display: none">
	
				<p>Here you can change the project status.<br/>
				Any changes made will be notified to the staff working on the project and some changes may require admin aproval.</p>

			</div>

		</div>
	</div>

</section>

<script type="text/javascript">var locations = <?php echo json_encode($locations, JSON_HEX_TAG); ?>;</script>
<script type="text/javascript" src="<?php echo base_url("assets/js/project-panel.js"); ?>" ></script>
