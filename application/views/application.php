<section id="application">

	<h1>Apply to Project</h1>
	<hr>

	<form method="post" id="apply-form">

		<div class="container-fluid content">

			<p>You are applying to this project. Please check that all information is correct as submitted applications cannot be modified.</p>
			
			<h1><?= $project->title ?></h1>
			<h3><?= $project->manager ?></h3>

			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<p>
			    		<b>From:</b>
			    		<span><?= date('d/m/Y', strtotime($project->start_date)) ?></span>
			    	</p>
					<p>
			    		<b>To:</b>
			    		<span><?= date('d/m/Y', strtotime($project->end_date)) ?></span>
			    	</p>
			    </div>
			    <div class="col-xs-6 col-sm-6 col-md-6" id="right-div">
			    	<p>
			    		<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> 
			    		<span><?= $project->location ?></span>
			    	</p>
			    </div>
			</div>
			<p><?= $project->description ?></p>

			<?php echo form_input($project_details); ?>

			<?php echo form_textarea($message); ?><br/>

			<?php echo form_submit('submit', 'Submit Application', 'id = "submit-application"'); ?>

	<?php echo form_close(); ?>

</section>
