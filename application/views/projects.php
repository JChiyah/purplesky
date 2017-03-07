<section id="current-projects">

    <h1>My Projects</h1>
    <hr>

    <div class="container-fluid projects">

        <?php if(isset($projects) && $projects) : ?>

            <?php foreach($projects as $project) : ?>
                
                <a class="container-fluid project-result" href="dashboard/<?= $project->project_id ?>">
                    <div class="row">
                        <h3 class="col-md-8"><?= $project->title ?></h3>
                        <span class="col-md-4 date">
                            <?= date('j/n/Y', strtotime($project->start_date)) ?> - 
                            <?= date('j/n/Y', strtotime($project->end_date)) ?>
                        </span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-10">
                            <h5><?= $project->manager ?></h5>
                            <p>Skills: 
                                <?php foreach($project->skills as $skill) : ?>
                                    <span class="skill-span"><?= $skill ?></span>
                                <?php endforeach ?>
                            </p>
                        </div>
                        <div class="col-md-2">
                            <p class="location">
                                <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $project->location ?></p>
                            <button class="g-button">View</button>
                        </div>
                    </div>
                </a>

            <?php endforeach ?>

        <?php else : ?>

            <?php if(isset($own_projects) && $own_projects) : ?>
   
                <?php foreach($own_projects as $project) : ?>
                
                    <a class="container-fluid project-result" href="dashboard/<?= $project->project_id ?>">
                        <div class="row">
                            <h3 class="col-md-8"><?= $project->title ?></h3>
                            <span class="col-md-4 date">
                                <?= date('j/n/Y', strtotime($project->start_date)) ?> - 
                                <?= date('j/n/Y', strtotime($project->end_date)) ?>
                            </span>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                <h5>You are managing this project</h5>
                                <p><?= $project->description ?></p>
                                <br/>
                            </div>
                            <div class="col-md-2">
                                <p class="location">
                                    <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> <?= $project->location ?></p>
                                <button class="g-button">View</button>
                            </div>
                        </div>
                    </a>
                    
                <?php endforeach ?>
        
            <?php else : ?>

                <p>No projects to show here.<br/>Try applying for projects in the <a href="search">search page</a>.</p>

            <?php endif ?>

        <?php endif ?>

    </div>
        
</section>
