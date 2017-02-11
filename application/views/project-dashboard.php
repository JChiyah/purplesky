<!-- 

	You are given 3 main variables (no need to define them, they are already created for you):

		- $project, which contains all the info about the project you may need. It is an object
		with the form project(title, description, priority, manager, location, budget, start_date, end_date)
		To get any property of this object, call $project->property (e.g. $project->title)

		- $staff is an array of objects. Similar to before, but this time you don't know how long the array is.
		The objects are staff(id, name, role, assigned_at, pay_rate). Same as before, you can access any 
		property calling: $staff->name etc. However, this time, it is an array. thus to access the name
		of the first employee, you would do $staff[0]->name, etc. It is more efficient doing it with a loop
		See the one I wrote for you. Use that to iterate through the unknown size array.

		- $dashboard is an array of dashboard entries(description, date). Same as staff, access it as an 
		array, and use a loop to show all entries.
-->

<div id="project-dashboard">
	<?php
	echo '<h1> <b>' . $project->title . '</b> </h1>
			<h2>' . $project->manager . '</h2>'; ?>
	<div class="projectview"> 
			<?php
			echo '<table>
			<tr>
			<td class="toptableleft">
			Start date: $projectdescription[0]
			</td>
			<td class="toptableright">
			Priority: $projectdescription[1]
			</td>
			</tr>
			<tr>
			<td class="toptableleft">
			End date:$projectdescription[2]
			</td>
			<td class="toptableright">
			Location:$projectdescription[3]
			</td>
			</tr>
			</table>
			<p> $projectdescription[4] </p>'; 
			if ($user== $projectowner){ //needs to be changed to the unique PM for the project, don't know how, put my best guess in
				echo '<form action="" method="post">
				<input type="text" name="" value="" placeholder="Enter updates to the project description here">
				<input type="submit" name="" value="Update Project Description" id="">
				</form>';
				}?>

	</div>

	<div class="projectstaff">
	<table>
		<tr>
			<th><b>Staff:</b></th>
			<th><b>Role:</b></th>
			<th><b>Since:</b></th>
			<th><b>Daily Rate:</b></th>
		</tr>
		<!-- need to check what format the variable will be returned in, preferably array of a 5 position array, 0=staff name,1= start date, 2=end date, 3=daily rate, 4=job name -->
		<?php 
			global $user_group;
			if(isset($staff) && $staff) {
				foreach ($staff as $employee) {
					echo '<tr>
							<td>' . $employee->name . '</td>
							<td>' . $employee->role . '</td>
							<td>' . $employee->assigned_at . '</td>
							<td>' . $employee->pay_rate . '</td>
						</tr>';
				}
			} else {
				echo '<p>No staff working in the project</p>';
			}
		if ($user_group != 1 && $user_group != 2){	
		echo '<hr>
			<p class="bottomtotal"><b>Total: £ $total </b></p>';

		}

			?>
	</table>
	</div>

</div>