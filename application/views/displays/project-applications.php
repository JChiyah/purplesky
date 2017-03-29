<?php if (isset($applications) && $applications && sizeof($applications) > 0): ?>

    <?php foreach($applications as $application) : ?>

		<div class="application" id="applications-<?= $application->id ?>">
			<h3><?= $application->name ?></h3>
			<hr>
			<div class="container-fluid">
				<div class="row">
					<p class="col-xs-6 group"><?= $application->group ?></p>
					<p class="col-xs-6 location right">
						<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $application->location ?>
					</p>
				</div>
				<div class="row">
					<p class="col-xs-12 col-sm-6"><?= $application->message ?></p>
					<p class="col-xs-12 col-sm-6 right pay-rate">£<?= $application->pay_rate ?>/day</p>
				</div>
				<div class="row">
					
					<div class="col-xs-12 col-sm-3"></div>

					<div class="col-xs-"></div>
				<button class="col-sm-3 g-button staff-profile">See profile</button>

					<a href="<?php echo site_url(strtolower(str_replace(' ','.',$application->name))); ?>" class="col-sm-3 g-button">See profile</a>
				</div>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No applications received</p>
    
<?php endif ?>
