<div id="search">
	<h1>Search for Projects</h1>

	<div class="container-box">
		<section id="quick-search">
			<?php global $user_group; if ($user_group != 1 && $user_group != 2) 
				{ echo '<p>Search for any current or future projects within the organisation</p>'; } else echo '<p>Search and apply for any current or future projects within the organisation</p>'; ?>
         	
         	<?php echo form_open();?>
				<?php echo form_input($keyword, '', 'placeholder="Enter keyword, project title or manager name"');?>
				<?php echo form_submit('submit', 'Search', "id='search-submit'");?>

				<div id="advanced-search">
					<hr>
					<p>You can fill in as many details as you want</p>
					<div class="container-fluid">
						<div class="col-sm-12 col-md-6">
							<div class="row date-row">
								<div class="col-md-3">
									<label>From:</label>
								</div>
								<div class="col-md-9">
									<?php echo form_date($start_date);?>
								</div>
							</div>
							<div class="row date-row">
								<div class="col-md-3">
									<label>To:</label>
								</div>
								<div class="col-md-9">
									<?php echo form_date($end_date);?>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<p>
								<label>Location:</label> <br>
								<?php echo form_dropdown($location, array_merge(array( 0 => 'Any'), $locations), 0);?>
							</p>
							<!--<p>
								<label>Onsite</label>
								<input type="checkbox" name="" value="onsite" checked>
							</p>-->
						</div>
					</div>
				</div>

			<?php echo form_close();?>
		</section>

		<button id="search-toggle">Open Advanced Search</button>
	</div>

	<section id="search-results">
		<div>
			<h2>Results:</h2>
			<label>Order by:</label>
			<select name="orderBy">
			 <option value="dailyRate">Date</option>
			 <option value="location">Locations</option>
		  </select>
		</div>
		<hr>
		<div id="results">
			<?php
				if(isset($projects) && $projects) {
					echo '<p>Showing all projects for now to ease styling</p>';
					foreach($projects as $project) {
						echo '<div class="project-result">
							<a href="dashboard/' . $project->project_id . '">
							<h3>' . $project->title . '</h3></a>
							<span>' . $project->manager . '</span>
							<p class="location">' . $project->location . '</p>
							<p class="date">' . $project->start_date . ' until ' . $project->end_date . '</p>
							<p class="description">' . $project->description . '</p>
							<button class="apply-button" id="apply-' . $project->project_id . '">Apply</button>
						</div>';
					}
				}
			?>
		</div>
	</section>

</div>
