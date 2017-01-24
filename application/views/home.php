<div id="home-page">
	<div class="container">
		<div class="row">
			<div class="home-container">
				<h2>Notifications</h2>
				<hr>
				<div class="content">

				</div>
			</div>

			<div class="home-container">
				<h2>Date</h2>
				<hr>
				<div class="content">
					<p><?php echo date('l jS, F Y', time()); ?></p>
					<p><?php echo date('h:i a', time()); ?></p>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-5">
				
			</div>
		</div>
	</div>
		<br>
		<!--Current projects and Recomended for you-->
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-4" id="HomeContainer">
				<h2>Current Projects</h2>
				<hr>
				<button>Project A</button>
				<button>Project B</button>
				<button>Project C</button>
			</div>
			<!--Recomended Section -->
			<div class="col-xs-12 col-md-6 col-lg-8" id="HomeContainer">
				<h2>Recomended for you</h2>
				<hr>
				<!--TODO fix CSS here for displaying projects - requ gliphys-->
				<div class="row" id="HomeContainer">
					<div class="col-xs-12 col-md-6 col-lg-8">
						<div class="row" id="left">
							<div class="col-xs-12 col-ms-3 col-md-3 col-lg-4" >
								<h3>ProjectD</h3>
								<p>Description</p>
								<p>Location</p>
								<p>Project Manager</p>
								<p>From "StartDate" to "EndDate"</p>
							</div>
							<div class="col-xs-12 col-ms-3 col-md-3 col-md-offset-3 col-lg-4 col-lg-offset-4">
								<h3>ProjectE</h3>
								<p>Description</p>
								<p>Location</p>
								<p>Project Manager</p>
								<p>From "StartDate" to "EndDate"</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<p><a href="auth/change_password">Change password</a></p>
</div>	<!--Container end-->
