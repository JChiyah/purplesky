<?php date_default_timezone_set('Europe/London'); ?>
<div id="home-page">
	<div class="container">
		<div class="home-container col-md-8 col-sm-12">
			<div class="content">
				<h2>Notifications</h2>
				<hr>
				<div id="notification-set">
					<div class="notification">
						<p>Report for <a href="#">Security Reinforcement</a> project is due soon</p>
						<p class="not-date">An hour ago</p>
					</div>
					<hr>
					<div class="notification">
						<p>You were assigned to the project <a href="#">Analysis of Resources</a></p>
						<p class="not-date">23 Jan 2017 at 11:29</p>
					</div>
					<hr>
					<div class="notification">
						<p>Address updated successfully</p>
						<p class="not-date">18 Jan 2017 at 9:45</p>
					</div>
				</div>
			</div>
		</div>

		<div class="home-container col-md-4 col-sm-12">
			<div class="content">
				<h2>Welcome</h2>
				<div id="date">
					<hr>
					<span id="day"><?php echo date('l', time()); ?></span>
					<span id="month"><?php echo date('M Y', time()); ?></span>
					<span id="num-day"><?php echo date('jS', time()); ?></span>
					<span id="time"><?php echo date('H:i', time()); ?></span>
				</div>
			</div>
		</div>
		<div class="home-container col-md-4 col-sm-12">
			<div class="content">
				<h2>Current Projects</h2>
				<hr>
				<a class="g-button" style="display: block;" href="#">Project A</a>
				<a class="g-button" style="display: block;" href="#">Project B</a>
				<a class="g-button" style="display: block;" href="#">Project C</a>
			</div>
		</div>
		<div class="home-container col-md-8 col-sm-12">
			<div class="content">
				<h2>Recommended for you</h2>
				<hr>
				<p>Nothing new to show</p>
			</div>
		</div>
	</div>
</div>
