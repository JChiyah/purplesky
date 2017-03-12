<?php if (isset($staff) && $staff && sizeof($staff) > 0): ?>

    <?php foreach($staff as $employee) : ?>

        <div class="staff-result" id="staff-<?= $employee->id ?>">
			<h5><?= $employee->name ?></h5>
			<p class="location"><?= $employee->location ?></p>
			<p class="pay-rate">£<?= $employee->pay_rate ?>/day</p>
			<div class="row">
				
				<div class="col-md-9" id="skill-set">
				<?php if(isset($skills) && $skills) : ?>

					Skills: 

					<?php foreach($skills as $skill) : ?>
	                    <span class="skill-span"><?= $skill ?></span>
	                <?php endforeach ?>
				
				<?php else : ?>

					<br/>

				<?php endif ?>
				</div>

				<button type="button" class="col-md-3 allocate-staff-button">Select</button>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No staff available</p>
    
<?php endif ?>
