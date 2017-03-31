<section class="container-fluid" id="project-management-panel">

	<h1>Project Management Panel</h1>
	<hr>

	<p>Here you can edit the project details, manage staff and other various tasks.</p>
	<span id="remaining-budget" <?php echo $remaining_budget < 0 ? 'style="color: #e74c3c"' : '' ?>>Budget: £<?= $remaining_budget ?></span>

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

			<div class="container-fluid tab" id="see-applications" <?php echo $action == 'application-status' ? '' : 'style="display: none"' ?>>

				<?php $this->load->view('project-panel/applications.php'); ?>

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

			<div class="container-fluid tab" id="add-staff" <?php echo $action == 'add-staff' ? '' : 'style="display: none"' ?>>
				
				<?php $this->load->view('project-panel/add-staff.php'); ?>

			</div>

			<div class="container-fluid tab" id="remove-staff" style="display: none">
				
				<?php $this->load->view('project-panel/remove-staff.php'); ?>

			</div>

		</div>
	</div>

	<div id="profile-popup" style="display: none">
		
	</div>

	<div id="confirmation-popup" style="display: none">
		<h3>Are you sure you want to continue?</h3>
		<p class="error-msg"></p>
	</div>

</section>

<script type="text/javascript">var locations = <?php echo json_encode($locations, JSON_HEX_TAG); ?>;</script>
<script type="text/javascript" src="<?php echo base_url("assets/js/project-panel.js"); ?>" ></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/staff-allocation.js"); ?>" ></script>
