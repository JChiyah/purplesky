<footer>
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="row">
		    <ul>
		      <li><a href="<?php echo site_url('index') ?>">Home</a></li>-
		      <li><a href="<?php echo site_url('index') ?>">My Projects</a></li>-
		      <li><a href="<?php echo site_url('profile') ?>">Profile</a></li>-
		      <li><a href="<?php echo site_url('index') ?>">Search</a></li>-
		      <li><a href="<?php echo site_url('index') ?>">Help</a></li>
		    </ul>
		</div>
		<div class="row">
		    <ul id="footer-bottom">
		      <li><a href="<?php echo site_url('index') ?>">Privacy Policy</a></li>|
		      <li><a href="<?php echo site_url('index') ?>">Terms of Use</a></li>|
		      <li><a id="logout" href="<?=  base_url('auth/logout')?>">Logout</a></li>
		    </ul>
		</div>
	</div>
	<div id="footer-right" class="col-md-4">
		<img id="footer-logo" src="assets/img/leidos-white.png" alt="Leidos logo">
	    <p>Powered by Purple Sky &#169 2016</p>
	</div>
</footer>
<!--<script type="text/javascript" src="inc/fnc/site.js"></script>-->