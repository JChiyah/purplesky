<section class="container-fluid" id="project-management-panel">

	<h1>Project Management Panel</h1>
	<hr>

	<p>Here you can edit the project details, manage staff and other various tasks.</p>

	<div class="container-fluid row">
		
		<div class="col-md-2" id="left-bar">
			
			<?php $this->load->view('project-panel/left-navbar.php'); ?>

		</div>

		<div class="container-fluid col-md-10">
			
			<div class="container-fluid tab" id="see-staff" <?php echo (isset($action) && $action) ? 'style="display: none"' : ''?>>
				<h2>Project Staff</h2>
				<hr>
				<div id="project-staff">

				</div>
			</div>

			<div class="container-fluid tab" id="see-tasks" style="display: none">
				<h2>Project Tasks</h2>
				<hr>
				<div id="project-tasks">

				</div>
			</div>

			<div class="container-fluid tab" id="see-applications" style="display: none">
				<h2>Project Applications</h2>
				<hr>
				<p>Applications received from employees.<br/> The project is currently <b><?= $project->applications ?></b> to new applications.</p>
				<div id="project-tasks">

				</div>
			</div>

			<div class="container-fluid tab" id="project-application-status" <?php echo $action == 'application-status' ? '' : 'style="display: none"' ?>>
				
				<?php $this->load->view('project-panel/application-status.php'); ?>

			</div>

			<div class="container-fluid tab" id="dashboard-entry" style="display: none">
				
				<?php $this->load->view('project-panel/add-entry.php'); ?>

			</div>

			<div class="container-fluid tab" id="edit-project" <?php echo isset($action) && $action == 'edit' ? '' : 'style="display: none"' ?>>
				
				<?php $this->load->view('project-panel/edit-project.php'); ?>

			</div>

			<div class="container-fluid tab" id="project-status" <?php echo $action == 'status' ? '' : 'style="display: none"' ?>>
				
				<?php $this->load->view('project-panel/project-status.php'); ?>

			</div>

			<div class="container-fluid tab" id="add-task" style="display: none">
				<h2>Add Task</h2>
				<hr>
				<div id="add-project-task">

				</div>
			</div>

			<div class="container-fluid tab" id="add-staff" <?php echo $action == 'add-staff' ? '' : 'style="display: none"' ?>>
				
				<?php $this->load->view('project-panel/add-staff.php'); ?>

			</div>

			<div class="container-fluid tab" id="edit-staff" style="display: none">
				<p>lol</p>
			</div>

			<div class="container-fluid tab" id="remove-staff" style="display: none">
				<h2>Remove Staff</h2>
				<hr>

				<p>Here you can remove staff working on the project. If the staff is working in a selected task, they will also be removed from it automatically.</p>
				
				<div id="remove-staff-list">

				</div>

			</div>

		</div>
	</div>

</section>

<script type="text/javascript">var locations = <?php echo json_encode($locations, JSON_HEX_TAG); ?>;</script>
<script type="text/javascript" src="<?php echo base_url("assets/js/project-panel.js"); ?>" ></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/staff-allocation.js"); ?>" ></script>
