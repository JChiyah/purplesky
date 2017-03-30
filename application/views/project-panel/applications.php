<h2>Project Applications</h2>
<hr>
<p>Applications received from employees.<br/> The project is currently <b><?= $project->applications ?></b> to new applications.</p>
<div id="project-applications">
	
</div>

<div class="container-fluid content" style="display: none">
	<?php echo form_open('', array('id' => 'accept-application-form')) ?>

		<p>You are adding this employee to the project</p>
		
		<h3 id="a_staff_name_summary"></h3>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6">
				<p>
		    		<b>Start date:</b>
					<span id="a_staff_start_date_summary"></span>
		    	</p>
		    	<p>
		    		<b>End date:</b>
		    		<span id="a_staff_end_date_summary"></span>
		    	</p>
		    </div>
		    <div class="col-xs-6 col-sm-6 col-md-6" id="right-div">
		    	<p>
		    		<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
		    		<span id="location_summary"><?= $project->location ?></span>
		    	</p>
		    </div>
		</div>

		<p>
			<label>Role:</label>
			<input type="text" name="role" value="General" id="a_staff_role">
		</p>
		<input type="hidden" value="" id="a_staff_id"/>

		<?php echo form_submit('submit', 'Add to Project');?>
		
		<button type="button" class="g-button" id="back-add">Go back</button>
	<?php echo form_close() ?>
</div>

<div id="application-accepted-confirm" style="display: none">

	<h3>Staff added succesfully</h3>
	
	<i class="fa fa-check fa-5x green-c" aria-hidden="true"></i>

	<button class="g-button" id="confirm-add-staff">See other applications</button>

	<button class="g-button" id="confirm-see-staff">See current staff</button>

</div>