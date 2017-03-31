<?php if (isset($staff) && $staff && sizeof($staff) > 0): ?>

    <?php foreach($staff as $employee) : ?>

		<div class="container-fluid staff-container">
			<h3><?= $employee->name ?></h3>
			<hr>
			<div class="container-fluid">
				<div class="row">
					<span class="col-xs-6">ID: <?= $employee->id ?></span>
					<p class="col-xs-6 location right">
						<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $employee->location ?>
					</p>
				</div>
				<div class="row">
					<p class="col-xs-6"><b><?= $employee->group ?></b></p>
					<p class="col-xs-12 col-sm-6 right">£<?= $employee->pay_rate ?>/day</p>
				</div>
				<div class="row">
					<p class="col-xs-12 col-sm-6"><?= date('d/m/Y', strtotime($employee->start_date)) ?> - <?= date('d/m/Y', strtotime($employee->end_date)) ?></p>
					<p class="col-xs-12 col-sm-6 right">Total cost: £<?= $employee->cost ?></p>
				</div>
				<div class="row" id="staff-<?= $employee->id ?>-<?= $employee->name ?>">
					
					<button class="col-xs-12 col-sm-3 g-button staff-profile">See profile</button>

					<div class="hidden-xs col-sm-6"></div>

					<button class="col-xs-12 col-sm-3 g-button remove-staff">Remove</button>
				</div>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No staff currently working for the project</p>
    
<?php endif ?>
