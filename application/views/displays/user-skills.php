<?php if (isset($user_skills) && $user_skills): ?>

	<?php foreach($user_skills as $skill): ?>
		
		<span class="skill-span"> <?= $skill->name ?> 
			<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i>
		</span>
	
	<?php endforeach ?>

<?php else : ?>

	<p>No skills to show here</p>

<?php endif ?>


