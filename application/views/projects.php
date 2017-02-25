<section id="current-projects">

    <h1>My Projects</h1>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
        <div id="dropdown-menu">
            <label>Order by:</label>
            <select id="orderBy" name="orderBy">
                <option value="newest-proj">Date (Newest first)</option>
                <option value="oldest-proj">Date (Oldest first)</option>
                <option value="priority">Priority (Urgent first)</option>
            </select>
        </div>
    </div>
    <hr>

    <div class="container-fluid projects">

        <div class="row project-result">
            <div class="left">
                <a href="#"><h2>Test Project</h2></a>
                <span>Manager example</span>
            </div>
            <div class="right">
                <p class="project-date">02-10-2016 - 16-11-2016</p>
                <p>Edinburgh</p>
            </div>
            <a class="view-button" href="#">VIEW</a>
        </div>

        <hr>
        
        <div class="row project-result">
            <div class="left">
                <a href="#"><h2>Test Project</h2></a>
                <span>Manager example</span>
            </div>
            <div class="right">
                <p class="project-date">02-10-2016 - 16-11-2016</p>
                <p>Edinburgh</p>
            </div>
            <a class="view-button" href="#">VIEW</a>
        </div>

        <hr>

        <div class="row project-result">
            <div class="left">
                <a href="#"><h2>Test Project</h2></a>
                <span>Manager example</span>
            </div>
            <div class="right">
                <p class="project-date">02-10-2016 - 16-11-2016</p>
                <p>Edinburgh</p>
            </div>
            <a class="view-button" href="#">VIEW</a>
        </div>
  
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
