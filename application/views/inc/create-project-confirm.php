<section class="container-fluid" id="project-confirm">

	<h1>Congratulations!</h1>

	<h3>The project <?= $project_title ?> has successfully been created!</h3>
	
	<i class="fa fa-check fa-5x green-c" aria-hidden="true"></i>

	<h5>You are now being redirected to your project dashboard where you can add staff to your project...</h5>

	<i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>

	<p>Please click <a href="<?= site_url('dashboard') ?>/<?= $project_id ?>">here</a> if it is taking too long to redirect</p>

</section>

<script type="text/javascript">
setTimeout(function(){
		window.location.replace(baseurl + 'dashboard/' + "<?= $project_id ?>");
	}, 5000);
</script>
