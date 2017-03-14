<?php
	if(isset($user_experiences) && $user_experiences) : ?>
		<?php foreach ($user_experiences as $experience) : ?>

			<div class="experience-box" id="experience-<?= $experience->experience_id ?>">
				<div class="row"><h2 class="col-md-9"> <?= $experience->role ?> </h2>
					<span class="col-md-3">
						<?= date('d/m/Y', strtotime($experience->start_date)) ?> -
						<?= date('d/m/Y', strtotime($experience->end_date)) ?>
					</span>
				</div>
				<p class="title">

				<?php if(isset($experience->project_id)) : ?>

					<a href="dashboard/' . $experience->project_id . '"> <?= $experience->institution ?> </a>

				<?php else : ?> <?= $experience->institution ?> <?php endif ?>
	
				</p>
				
				<p> <?= $experience->description ?> </p>

				<div class="row">
					<p class="col-md-10">
						
						<?php if(!empty($experience->skills) && sizeof($experience->skills) > 0) : ?>
							Skills: 

	                        <?php foreach($experience->skills as $skill) : ?>
	                            <span class="skill-span"><?= $skill ?></span>
	                        <?php endforeach ?>

	                    <?php endif ?>

                    </p>
					<button class="g-button delete-experience-tag col-md-2"> 
						<i class="fa fa-times fa-lg" aria-hidden="true"></i> Delete
					</button>
				</div>
			</div>
			<hr>
		<?php endforeach ?>

<?php else : ?>

	<p>No previous experiences to show here</p>

<?php endif ?>