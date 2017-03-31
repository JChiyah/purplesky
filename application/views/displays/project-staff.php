<?php if (isset($staff) && $staff && sizeof($staff) > 0): ?>

    <?php foreach($staff as $employee) : ?>

		<div class="container-fluid staff-container" id="staff-<?= $employee->id ?>">
			<h3><?= $employee->name ?></h3>
			<hr>
			<div class="container-fluid">
				<div class="row">
					<span class="col-xs-6">ID: <?= $employee->id ?></span>
					<p class="col-xs-12 col-sm-6 right"><?= date('d/m/Y', strtotime($employee->start_date)) ?> - <?= date('d/m/Y', strtotime($employee->end_date)) ?></p>
				</div>
				<div class="row">
					<p class="col-xs-6"><b><?= $employee->group ?></b></p>
					<p class="col-xs-6 location right">
						<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $employee->location ?>
					</p>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6" id="skill-set">
					<?php if(isset($skills) && $skills) : ?>
						Skills: 
						<?php foreach($employee->skills as $skill) : ?>
		                    <span class="skill-span"><?= $skill ?></span>
		                <?php endforeach ?>
					<?php endif ?>
					</div>
					<p class="col-xs-12 col-sm-6 right">£<?= $employee->pay_rate ?>/day</p>
				</div>
				<p class="right">Total cost: £<?= $employee->cost ?></p>
				<div class="row" id="staff-<?= $employee->id ?>-<?= $employee->name ?>">
					
					<button class="col-xs-12 col-sm-3 g-button staff-profile">See profile</button>

					<div class="hidden-xs col-sm-6"></div>

					<a href="<?php echo site_url(strtolower(str_replace(' ','.',$employee->name))); ?>" class="col-sm-3 g-button">Visit profile</a>
				</div>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No staff available</p>
    
<?php endif ?>
