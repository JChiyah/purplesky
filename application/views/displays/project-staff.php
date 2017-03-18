<?php if (isset($staff) && $staff && sizeof($staff) > 0): ?>

    <?php foreach($staff as $employee) : ?>

        <div class="staff-result" id="staff-<?= $employee->id ?>">
			<h5><?= $employee->name ?></h5>
			<p class="location"><?= $employee->location ?></p>
			<p class="pay-rate">£<?= $employee->pay_rate ?>/day</p>
			<div class="row">
				
				<div class="col-md-9" id="skill-set">
				<?php if(isset($employee->skills) && $employee->skills) : ?>

					Skills: 

					<?php foreach($employee->skills as $skill) : ?>
	                    <span class="skill-span"><?= $skill ?></span>
	                <?php endforeach ?>
				
				<?php else : ?>

					<br/>

				<?php endif ?>
				</div>

				<a href="<?php echo site_url(strtolower(str_replace(' ','.',$employee->name))); ?>" class="col-md-3 g-button">See profile</a>
			</div>
		</div>

    <?php endforeach ?>

<?php else : ?>

    <p>No staff available</p>
    
<?php endif ?>
