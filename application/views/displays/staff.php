<?php if (isset($staff) && $staff && sizeof($staff) > 0): ?>

    <?php foreach($staff as $employee) : ?>
		
		<div class="staff-result" id="staff-<?= $employee->id ?>">
			<h5 class="staff-name"><?= $employee->name ?></h5>
			<hr>
			<div class="row">
				<p class="col-xs-6 group"><?= $employee->group ?></p>
				<p class="col-xs-6 location">
					<i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $employee->location ?>
				</p>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6" id="skill-set">
					<?php if(isset($employee->skills) && $employee->skills) : ?>
						Skills: 
						<?php foreach($employee->skills as $skill) : ?>
		                    <span class="skill-span"><?= $skill->name ?></span>
		                <?php endforeach ?>
		            <?php endif ?>
				</div>
				<p class="col-xs-12 col-sm-6 pay-rate">£<?= $employee->pay_rate ?>/day</p>
			</div>
			<?php if(isset($employee->busy) && $employee->busy): ?>
			<div class="row">
				<p class="staff-availability">
					<?php switch($employee->busy) {
						case 'staff':
							echo 'Currently working for this project';
							break;
						case 'work':
							echo 'Working on another project';
							break;
						case 'training':
							echo 'Training during this period';
							break;
						default:
							echo 'Not available during this period';
					} ?>
				</p>
			</div>
			<?php endif ?>
			<div class="row">

				<button class="col-sm-3 g-button staff-profile">See profile</button>
				
				
					<div class="col-xs-9">
						
					</div>
					<div class="col-xs-6"></div>

					<button type="button" class="col-sm-3 g-button allocate-staff-button">Add to project</button>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No staff found</p>
    
<?php endif ?>
