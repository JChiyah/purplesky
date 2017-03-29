<?php if (isset($applications) && $applications && sizeof($applications) > 0): ?>

    <?php foreach($applications as $application) : ?>

		<div class="application" id="applications-<?= $application->id ?>">
			<h5><?= $application->name ?></h5>
			<hr>
			<div class="row">
				<p class="col-xs-6 group"><?= $application->group ?></p>
				<p class="col-xs-6 location">
					<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $application->location ?>
				</p>
			</div>
			<div class="row">
				<p class="col-xs-12 col-sm-6"><?= $application->message ?></p>
				<p class="col-xs-12 col-sm-6 pay-rate">£<?= $application->pay_rate ?>/day</p>
			</div>
			<div class="row">
				
				<div class="col-xs-3"></div>

				<div class="col-xs-6"></div>

				<a href="<?php echo site_url(strtolower(str_replace(' ','.',$application->name))); ?>" class="col-sm-3 g-button">See profile</a>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No applications received</p>
    
<?php endif ?>
