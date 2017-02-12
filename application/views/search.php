<div id="search">
	<h1>Search for Projects</h1>

	<div class="container-box">
		<section id="quick-search">
			<?php global $user_group; if ($user_group != 1 && $user_group != 2) 
				{ echo '<p>Search for any current or future projects within the organisation</p>'; } else echo '<p>Search and apply for any current or future projects within the organisation</p>'; ?>
			<form action="" method="post">
				<input type="text" name="" value="" placeholder="Enter keyword, project title or manager name">
				<input type="submit" name="" value="Search" id="">

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
									<input type="date" name="" value="">
								</div>
							</div>
							<div class="row date-row">
								<div class="col-md-3">
									<label>To:</label>
								</div>
								<div class="col-md-9">
									<input type="date" name="" value="">
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<p>
								<label>Location:</label> <br>
								<?php echo form_dropdown($location, $locations);?>
							</p>
							<p>
								<label>Onsite</label>
								<input type="checkbox" name="" value="onsite" checked>
							</p>
						</div>
					</div>
				</div>

			</form>
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
					foreach($projects as $project) {
						echo '<div class="project-result">
								<h3>' . $project->title . '</h3>
								<span>' . $project->manager . '</span>
								<p>' . $project->location . '</p>
								<p>' . $project->start_date . ' until ' . $project->end_date . '</p>
								<p>' . $project->description . '</p>
							</div>';
					}
				}
			?>
		</div>
	</section>

</div>
