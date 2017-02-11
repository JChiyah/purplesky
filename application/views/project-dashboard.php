<div id="project-dashboard">
	<!--TODO:: find variable type for fetching project name, then echo it -->
	<?php global $projecttitle;/*find variable type */ 
		global $projecttitle;
	echo '<h1> <b>$projecttitle</b> </h1>
			<h2> $projectmanager'; ?>
	<div class="projectview"> 
			<!-- need to check what format the variable will be returned in, preferably array of a 5 position array, 0=start date name,1= priority, 2=end date, 3=location, 4=description -->
			<?php global $projectdescription;
				global $user;
				global $projectowner;
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
				<form action="" method="post">
				<input type="text" name="" value="" placeholder="Enter updates to the project description here">
				<input type="submit" name="" value="Update Project Description" id="">
				</form>
				}?>

	</div>

	<div class="projectstaff">
	<table>
		<tr>
			<th><b>Staff:</b></th>
			<th><b>From:</b></th>
			<th><b>To:</b></th>
			<th><b>Daily Rate:</b></th>
		</tr>
		<!-- need to check what format the variable will be returned in, preferably array of a 5 position array, 0=staff name,1= start date, 2=end date, 3=daily rate, 4=job name -->
		<?php global $projectstaff;
			$x=0;
			$total=0;
			global $user_group;
			$staff = array(projectstaff[x] );
			
			while (projectstaff[x] != null){
				if ($user_group != 1 && $user_group != 2){
				echo '<tr> 
					<td>$staff[0]</td>
					<td>$staff[1]</td>
					<td>$staff[2]</td>
					<td>£ $staff[3]</td>
				 </tr>
				 <tr>
				 <td class="jobname">$staff[4]</td>
				 </tr>';
				 $total=$total+$staff[3];
				 
				}
				else {echo '<tr> 
					<td>$staff[0]</td>
					<td>$staff[1]</td>
					<td>$staff[2]</td>
					</tr>
					<tr>
				 <td class="jobname">$staff[4]</td>
				 </tr>';
				}
				 $x=$x+1;
				 $staff = array(projectstaff[x] );

		}
		if ($user_group != 1 && $user_group != 2){	
		echo '<hr>
			<p class="bottomtotal"><b>Total: £ $total </b></p>';

		}

			?>
	</table>
	</div>

</div>