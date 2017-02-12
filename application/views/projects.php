<div id="current-projects">
	
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
</div>

<div id="container-fluid">
    <div id="project-container-fluid">
        <div class="content">
            <h2><?php echo $project->name; ?></h2>
            <h3><?php echo $project-manager->name; ?> </h3>
            <p><?php echo $project-start->date; ?> </p>
            <p><?php echo $project-end->date; ?> </p>
            <p><?php echo $project->location; ?> </p>
            <hr>
            <label>Matching skills:</label>
            <ul id="matching-skills">

                <!-- SQL statement to generate matching skills here -->

            </ul>
            <button id="view">VIEW</button>
        </div>
    </div>
</div>

