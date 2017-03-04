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
  
    </div>

    <?php
        /** This is the code used to generate multiple blocks of code. Do not use yet **
            The code inside the "echo" will be changed to match your block of code above 

        if(isset($projects) && $projects) {
            foreach($projects as $project) {
                echo '
                <div class="project-result">
                    <a href="dashboard/' . $project->project_id . '">
                    <h3>' . $project->title . '</h3></a>
                    <span>' . $project->manager . '</span>
                    <p class="location">' . $project->location . '</p>
                    <p class="date">' . $project->start_date . ' until ' . $project->end_date . '</p>
                    <p class="description">' . $project->description . '</p>
                    <button class="apply-button" id="apply-' . $project->project_id . '">Apply</button>
                </div>';
            }
        }*/
    ?>

</section>
