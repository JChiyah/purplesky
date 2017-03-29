<?php if (isset($applications) && $applications && sizeof($applications) > 0): ?>

    <?php foreach($applications as $application) : ?>

		<div class="container-fluid application">
			<div class="row">
				<h3 class="col-xs-9"><?= $application->name ?></h3>
				<span class="col-xs-3 right"><?= time_elapsed_string($application->date) ?></span>
			</div>
			<hr>
			<div class="container-fluid">
				<div class="row">
					<span class="col-xs-6">ID: <?= $application->id ?></span>
					<p class="col-xs-6 right">
						<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $application->location ?>
					</p>
				</div>
				<div class="row">
					<p class="col-xs-6"><b><?= $application->group ?></b></p>
					<p class="col-xs-12 col-sm-6 right">£<?= $application->pay_rate ?>/day</p>
				</div>
				<div class="row">
					<p class="col-xs-12 col-sm-6"><?= date('d/m/Y', strtotime($application->start_date)) ?> - <?= date('d/m/Y', strtotime($application->end_date)) ?></p>
					<p class="col-xs-12 col-sm-6 right">Total cost: £<?= $application->cost ?></p>
				</div>
				<p><?= $application->message ?></p>
				<div class="row" id="applications-<?= $application->id ?>">
					
					<button class="col-xs-12 col-sm-3 g-button application-profile">See profile</button>

					<div class="hidden-xs col-sm-3"></div>

					<button class="col-xs-12 col-sm-2 g-button application-reject">Reject</button>

					<div class="hidden-xs col-sm-1"></div>

					<button class="col-xs-12 col-sm-3 g-button application-accept">Add to project</button>
				</div>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No applications received</p>
    
<?php endif ?>
