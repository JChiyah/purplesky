<div id="newProject">
   <div class="container">
     <!--TODO:: responsive issues with mobile and requires rescaling in css-->
      <h1>Create new Project</h1>
      <h2>Step 1: Project Details</h2> <hr>

      <div class="container-box container-fluid">
        <form class="" action="index.html" method="post">
          <p>Please fill out all fields.</p>

          <div class="row">
            <div class="col-sm-12 col-md-6">
              <label>Title:</label>
              <input type="text" name="title" value="" required>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-md-8">
              <label>Description:</label>
              <textarea rows="5" cols="10" name="" value="" required></textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="row date-row">
                <div class="col-md-3">
                  <label>From:</label>
                </div>
              <div class="col-md-9">
                <input type="date" name="" value="">
              </div>
             </div>
             <div class="row date-row">
               <div class="col-md-3">
                  <label>To:</label>
                </div>
                <div class="col-md-9">
                  <input type="date" name="" value="">
                </div>
              </div>
            </div>
          </div>

        <div class="row">
          <div class="col-sm-12 col-md-6">
            <label>Location:</label>
              <select name="location">
                <option value="select">Select</option>
                <option value="test 1">Test 1</option>
                <option value="test 2">Test 2</option>
              </select>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 col-md-6">
            <label>Priority:</label>
            <select name="priority">
               <option value="normal">Normal</option>
               <option value="high">High</option>
            </select>
          </div>
          <div class="col-sm-12 col-md-6">
            <input type="submit" name="submit" value="continue">
          </div>
        </div>

      </form>

      </div><!--container-box-->
   </div><!--container-->
</div><!--npend-->
