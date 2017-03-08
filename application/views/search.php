<div id="search">
	<h1>Search for Projects</h1>

	<div class="container-box">
		<section id="quick-search">
			<?php global $user_group; if ($user_group != 1 && $user_group != 2) 
				{ echo '<p>Search for any current or future projects within the organisation</p>'; } else echo '<p>Search and apply for any current or future projects within the organisation</p>'; ?>
         	
         	<?php echo form_open();?>
				<?php echo form_input($keyword, '', 'placeholder="Enter description keyword, project title or manager name"');?>
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

		<button id="search-toggle"><i class="fa fa-caret-down fa-2x" aria-hidden="true"></i></button>
	</div>

	<section id="search-results">
		<div>
			<h2>Results</h2>
		</div>
		<hr>
		<div id="results">
			
		</div>
	</section>

</div>
