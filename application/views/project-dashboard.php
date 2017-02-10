<div id="project-dashboard">
	<!--TODO:: find variable type for fetching project name, then echo it -->
	<?php global $projecttitle;/*find variable type */ 
	echo '<h1> $projecttitle </h1>'; ?>
	<div class="projectview"> 
			<?php global $projectdescription;
			echo '<p> $projectdescription </p>'; ?>
	</div>

	<div class="projectstaff">
	<table>
		<tr>
			<th>Staff</th>
			<th>From:</th>
			<th>To:</th>
			<th>Daily Rate:</th>
		</tr>
		<!-- need to check what format the variable will be returned in, preferably array of a 4 position array, 0=staff name,1= start date, 2=end date, 3=daily rate, 4=job name -->
		<?php global $projectstaff;
			$x=0;
			global $user_group;
			$staff = array(projectstaff[x] );
			
			while (projectstaff[x] != null){
				if ($user_group != 1 && $user_group != 2){
				echo '<tr> 
					<td>$staff[0]</td>
					<td>$staff[1]</td>
					<td>$staff[2]</td>
					<td>$staff[3]</td>
				 </tr>
				 <tr>
				 <td>$staff[4]</td>
				 </tr>';
				 
				}
				else {echo '<tr> 
					<td>$staff[0]</td>
					<td>$staff[1]</td>
					<td>$staff[2]</td>
					</tr>
					<tr>
				 <td>$staff[4]</td>
				 </tr>';
				}
				 $x=$x+1;
				 $staff = array(projectstaff[x] );

		}	

			?>
	</table>
	</div>

</div>