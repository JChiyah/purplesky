<footer>
	<div class="hidden-xs col-md-3 col-lg-4"></div>
	<div class="col-sm-12 col-md-5 col-lg-4" id="footer-center">
		<div class="row">
		    <ul>
		        <li><a href="<?php echo site_url('index') ?>">Home</a></li>-
		        <li><a href="<?php echo site_url('projects') ?>">Projects</a></li>-
     		    <li><a href="<?php echo site_url('profile') ?>">Profile</a></li>
		        <li><a href="<?php echo site_url('search') ?>">Search</a></li>-
		        <li><a href="<?php echo site_url('index') ?>">Help</a></li>
		    </ul>
		</div>
		<div class="row">
		    <ul id="footer-bottom">
		        <li><a href="<?php echo site_url('index') ?>">Privacy Policy</a></li>|
		        <li><a href="<?php echo site_url('index') ?>">Terms of Use</a></li>|
		        <li><a id="logout" href="<?= base_url('auth/logout')?>">Sign out</a></li>
		    </ul>
		</div>
	</div>
	<div id="footer-right" class="col-sm-12 col-md-4 col-lg-4">
		<img src="<?= base_url('assets/img/leidos-white.png') ?>" alt="Leidos logo">
	    <p>Powered by Purple Sky &#169 2016</p>
	</div>
</footer>
