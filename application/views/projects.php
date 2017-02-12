<section id="current-projects">
	
<!-- Code here -->

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
    
    <div id="container-fluid">
        <!-- DO NOT USE IDs for this. Read: https://css-tricks.com/the-difference-between-id-and-class/ -->
        <div id="project-container-fluid">
            <div class="content">
                <h2>Test Project</h2>
                <h3>Manager example</h3>
                <p>02-10-2016</p>
                <p>16-11-2016</p>
                <p>Edinburgh</p>
                <hr>
                <!--<label>Matching skills:</label>
                <ul id="matching-skills">

                    <!-- Ignore matching skills - Not fully implemented yet

                </ul>-->
                <button id="view">VIEW</button>
            </div>
        </div>
    
        <!-- My recommended block of code to work on -->
        <div class="project">
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
        
        <!-- Whichever you choose, just delete the other one and repeat the block 3 times,
            one after another, like this:
            
            block
            block
            block

            So it gives you an idea how it would look with more than 1 project at the same time-->
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



