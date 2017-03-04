<section id="current-projects">

    <h1>My Projects</h1>
    <hr>

    <div class="container-fluid projects">

        <a class="container-fluid project-result" href="dashboard/#">
            <div class="row">
                <h3 class="col-md-8">Project title</h3>
                <span class="col-md-4 date">11/10/2017 - 12/10/2017</span>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-10">
                    <h5>Project manager</h5>
                    <p>Matching skills: <span class="skill-span">Java</span><span class="skill-span">CSS</span></p>
                </div>
                <div class="col-md-2">
                    <p class="location"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> Edinburgh</p>
                    <button class="g-button">View</button>
                </div>
            </div>
        </a>

        <a class="container-fluid project-result" href="dashboard/#">
            <div class="row">
                <h3 class="col-md-8">Project title</h3>
                <span class="col-md-4 date">11/10/2017 - 12/10/2017</span>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-10">
                    <h5>Project manager</h5>
                    <p>Matching skills: <span class="skill-span">Java</span><span class="skill-span">CSS</span></p>
                </div>
                <div class="col-md-2">
                    <p class="location"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> Edinburgh</p>
                    <button class="g-button">View</button>
                </div>
            </div>
        </a>

        <a class="container-fluid project-result" href="dashboard/#">
            <div class="row">
                <h3 class="col-md-8">Project title</h3>
                <span class="col-md-4 date">11/10/2017 - 12/10/2017</span>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-10">
                    <h5>Project manager</h5>
                    <p>Matching skills: <span class="skill-span">Java</span><span class="skill-span">CSS</span></p>
                </div>
                <div class="col-md-2">
                    <p class="location"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> Edinburgh</p>
                    <button class="g-button">View</button>
                </div>
            </div>
        </a>

    <?php if(isset($projects) && $projects) : ?>
        <?php foreach($projects as $project) : ?>
            
            <a class="container-fluid project-result" href="dashboard/#">
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
                        <p>Matching skills: 
                            <span class="skill-span">Java</span>
                            <span class="skill-span">CSS</span>
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
            <p>No projects to show here.<br/>Try applying for project in the <a href="search">search page</a>.</p>
    <?php endif ?>

    </div>
</section>
