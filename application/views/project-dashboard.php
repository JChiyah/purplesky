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
			<b>Start date:</b> ' . $project->start_date . '
			</td>
			<td class="toptableright">
			<b>Priority:</b> ' . $project->priority . '
			</td>
			</tr>
			<tr>
			<td class="toptableleft">
			<b>End date:</b> ' . $project->end_date . '
			</td>
			<td class="toptableright">
			<b>Location:</b> ' . $project->location . '
			</td>
			</tr>
			</table>
			<hr>
			<p><b>Notificaions</b></p>';
			foreach ($dashboard as $entry) {
				echo '<p> <b>Date: ' . $entry->date . '</b></p>
				<p>' . $entry->description .'</p>
				';
			}
			
			
			echo '<hr>
			<p><b>Description:</b></p> <p>' . $project->description . '</p>
			'; 
			if ($is_manager){ 
				echo '<form action="" method="post">
				<input type="text" name="" value="" placeholder="Enter a new notification">
				<input type="submit" name="" value="New Notification" id="">
				</form>';
			echo '<hr';
			}
			
			
		?>

	</div>

	<div class="projectstaff">
		<table>
			<tr>
				<th class="tablename"<b>Staff:</b></th>
				<th class="tablerole"><b>Role:</b></th>
				<th class="tabledate"><b>Since:</b></th>
				<th class="tablepay"><b>Daily Rate:</b></th>
			</tr>
			<!-- need to check what format the variable will be returned in, preferably array of a 5 position array, 0=staff name,1= start date, 2=end date, 3=daily rate, 4=job name -->
			<?php 
				echo "<hr>";
				if(isset($staff) && $staff) {
					foreach ($staff as $employee) {
						
						echo '<tr>
								<td>' . $employee->name . '</td>
								<td>' . $employee->role . '</td>
								<td>' . date('d/m/Y', strtotime($employee->assigned_at)) . '</td>
								<td class="tablepay">£ ' . $employee->pay_rate . '</td>
							</tr>';
					}
				} else {
					echo '</table>
					<p>No staff working in the project</p>';
				}
				echo "</table>
				</div>";
			if ($user_group == 1 || $user_group == 2){	
			echo '<hr>
				<p class="bottomtotal"><b>Total: £ '. $project->budget . '</b></p>';

			}

				?>
		
	

</div>
