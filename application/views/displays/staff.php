<?php if (isset($staff) && $staff && sizeof($staff) > 0): ?>

    <?php foreach($staff as $employee) : ?>

		<div class="container-fluid search-result" id="user-<?= $employee->id ?>">
			<div class="row">
				<h3 class="col-md-8 project-title"><?= $employee->name ?></h3>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-8">
					<span>ID: <?= $employee->id ?></span>
					<h5><?= $employee->group ?></h5>
					<p class="description">
						<?php if(isset($employee->busy) && $employee->busy): ?>
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
						<?php endif ?>
					</p>
					<div id="skill-set">
						<?php if(isset($employee->skills) && $employee->skills) : ?>
							Skills: 
							<?php foreach($employee->skills as $skill) : ?>
			                    <span class="skill-span"><?= $skill->name ?></span>
			                <?php endforeach ?>
			            <?php endif ?>
					</div>
				</div>
				<div class="col-md-4 right">
					<p class="location"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $employee->location ?></p>
					<p class="pay-rate">£<?= number_format($employee->pay_rate) ?>/day</p>
					<div class="row">
						<div class="col-md-6">
							<button class="g-button user-quick-view">Preview</button>
						</div>
						<div class="col-md-6">
							<a href="<?php echo site_url(strtolower(str_replace(' ','.',$employee->name))); ?>" class="g-button">See profile</a>
						</div>
					</div>
				</div>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No staff found</p>
    
<?php endif ?>
