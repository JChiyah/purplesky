<?php if (isset($staff) && $staff && sizeof($staff) > 0): ?>

    <?php foreach($staff as $employee) : ?>

		<div class="staff-result" id="staff-<?= $employee->id ?>">
			<h5><?= $employee->name ?></h5>
			<hr>
			<div class="row">
				<p class="col-xs-6 group"><?= $employee->group ?></p>
				<p class="col-xs-6 location">
					<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $employee->location ?>
				</p>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6" id="skill-set">
					<?php if(isset($skills) && $skills) : ?>
						Skills: 
						<?php foreach($skills as $skill) : ?>
		                    <span class="skill-span"><?= $skill ?></span>
		                <?php endforeach ?>
					<?php endif ?>
				</div>
				<p class="col-xs-12 col-sm-6 pay-rate">£<?= $employee->pay_rate ?>/day</p>
			</div>
			<div class="row">
				
				<a href="<?php echo site_url(strtolower(str_replace(' ','.',$employee->name))); ?>" class="col-sm-3 g-button">See profile</a>

				<div class="col-xs-6"></div>

				<button type="button" class="col-sm-3 g-button allocate-staff-button">Add to project</button>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No staff available</p>
    
<?php endif ?>
