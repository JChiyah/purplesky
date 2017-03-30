<h3><?= $project->title ?></h3>
<span>ID: <?= $project->project_id ?></span>
<ul>
	<li>
	<button <?php echo isset($action) && $action ? '' : 'class="active"' ?> id="staff">Project Staff</button>
	</li>
	<li><button id="applications">Applications</button></li>
	<li><button <?php echo $action == 'application-status' ? 'class="active"' : '' ?> id="application-status">Change Application Status</button></li>
	<li><button id="notification">Add Notification</button></li>
	<li><button <?php echo $action == 'edit' || $action == 'edit-confirm' ? 'class="active"' : '' ?> id="edit">Edit Project</button></li>
	<li><button <?php echo $action == 'status' ? 'class="active"' : '' ?> id="status">Change Project Status</button></li>
	<li><button <?php echo $action == 'add-staff' ? 'class="active"' : '' ?> id="add">Add Staff</button></li>
	<li><button id="remove">Remove Staff</button></li>
</ul>