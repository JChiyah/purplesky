<section class="container-fluid" id="project-confirm">

	<h1>Account created!</h1>

	<h3>The user can log in to the system using the email and password provided</h3>
	
	<i class="fa fa-check fa-5x green-c" aria-hidden="true"></i>

	<h5>You are now being redirected to home...</h5>

	<i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>

	<p>Please click <a href="<?= site_url('index') ?>">here</a> if it is taking too long to redirect</p>

</section>

<script type="text/javascript">
setTimeout(function(){
		window.location.replace(baseurl + 'index');
	}, 5000);
</script>
