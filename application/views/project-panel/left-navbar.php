<ul>
	<li>
	<button <?php echo isset($action) && $action ? '' : 'class="active"' ?> id="staff">Project Staff</button>
	</li>
	<li><button id="tasks">Project Tasks</button></li>
	<li><button id="applications">Applications</button></li>
	<li><button <?php echo $action == 'application-status' ? 'class="active"' : '' ?> id="application-status">Change Application Status</button></li>
	<li><button id="notification">Add Notification</button></li>
	<li><button <?php echo $action == 'edit' || $action == 'edit-confirm' ? 'class="active"' : '' ?> id="edit">Edit Project</button></li>
	<li><button <?php echo $action == 'status' ? 'class="active"' : '' ?> id="status">Change Project Status</button></li>
	<li><button id="task">Add Task</button></li>
	<li><button <?php echo $action == 'add-staff' ? 'class="active"' : '' ?> id="add">Add Staff</button></li>
	<li><button id="edit-s">Edit Staff</button></li>
	<li><button id="remove">Remove Staff</button></li>
</ul>