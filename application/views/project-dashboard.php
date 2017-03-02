<?php global $user_group; ?>
<div id="project-dashboard">
	<?php 
		echo '<h1> <b>' . $project->title . '</b> </h1>
			<h2>' . $project->manager . '</h2>'; ?>
	<div class="projectview"> 
			<?php
			echo '<table>
			<tr>
			<td class="toptableleft">
			Start date: ' . $project->start_date . '
			</td>
			<td class="toptableright">
			Priority: ' . $project->priority . '
			</td>
			</tr>
			<tr>
			<td class="toptableleft">
			End date: ' . $project->end_date . '
			</td>
			<td class="toptableright">
			Location: ' . $project->location . '
			</td>
			</tr>
			</table>
			<p><b>Notificaions</b></p>';
			foreach ($dashboard as $entry) {
				echo '<p> Date: ' . $entry->date . '</p>
				<p>' . $entry->description .'</p>';
			}
			
			
			echo '<hr>
			<p><b>Description:</b>' . $project->description . '</p>
			'; 
			if ($is_manager){ 
				echo '<form action="" method="post">
				<input type="text" name="" value="" placeholder="Enter a new notification">
				<input type="submit" name="" value="New Notification" id="">
				</form>';
			}
			
			echo '<hr';
		?>

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
				
				if(isset($staff) && $staff) {
					foreach ($staff as $employee) {
						
						echo '<tr>
								<td>' . $employee->name . '</td>
								<td>' . $employee->role . '</td>
								<td>' . $employee->assigned_at . '</td>
								<td>£ ' . $employee->pay_rate . '</td>
							</tr>';
					}
				} else {
					echo '<p>No staff working in the project</p>';
				}
			if ($user_group != 1 && $user_group != 2){	
			echo '<hr>
				<p class="bottomtotal"><b>Total: £ '. $project->budget . '</b></p>';

			}

				?>
		</table>
	</div>

</div>
</div>