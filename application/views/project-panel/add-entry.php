<h2>Add Notification</h2>
<hr>
<p>Here you can add a new notification to the project dashboard that everyone can see.<br/>
Staff working in the project will also be notified</p>

<div class="container-fluid content">
	<form method="post" id="new-entry">
		<input type="text" name="" id="entry-description" placeholder="Enter a new notification" maxlength="250">
		<input type="submit" name="" value="Add notification" id="dashboard-entry-submit">
		<input type="hidden" name="" value="<?= $project->project_id ?>" id="project_id">
	</form>
</div>

<div id="another-entry" style="display: none">
	<span class="confirm-msg">New entry added!</span>
	<i class="fa fa-check fa-5x green-c" aria-hidden="true"></i>					
	<button>Add another entry</button>
</div>