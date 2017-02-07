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
		<!-- need to check what format the variable will be returned in, preferably array of a 4 position array, 0=staff name,1= start date, 2=end date, 3=daily rate  -->
		<?php global $projectstaff;
			$x=0;
			$staff = array(projectstaff[x] );
			
			while (projectstaff[x] != null){
				echo '<tr>
					<th>$staff[0]</th>
					<th>$staff[1]</th>
					<th>$staff[2]</th>
					<th>$staff[3]</th>
				 </tr>';
				 $x=$x+1;

		}	

			?>
	</table>
	</div>

</div>