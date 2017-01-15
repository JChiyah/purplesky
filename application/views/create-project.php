
<div class="container">

  <h1>Create new Project</h1>
<!--Offseft the contents of container from the left -->
  <div class="row">
    <h3>Step 1: Project Details</h3>
    <hr>
    <div class="col-xs-12 col-sm-6 col-md-12">Please fill out all fields.
      <form class="" action="index.html" method="post">
        Title: <br>
        <input type="text" name="title" value="" required>
        <p></p>
        Description: <br>
        <textarea rows="5" cols="50" name="" value="" required></textarea>
        <p></p>
        From:
        <input type="date" name="fromDate" value="DD/MM/YYYY" required>
        <p></p>
        To:
        <input type="date" name="toDate" value="DD/MM/YYYY" required>
        <p></p>
        Location: <br>
        <select name="location">
          <!--TODO pull data from database for drop down selection - need to validate input(required)-->
          <option value="select">Select</option>
          <option value="test 1">Test 1</option>
          <option value="test 2">Test 2</option>
        </select>
        <p></p>
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-4">
            Priority:
            <select name="priority">
              <option value="normal">Normal</option>
              <option value="high">High</option>
            </select>
            <div class="col-xs-12 col-sm-6 col-md-offset-8">
              <input type="submit" name="submit" value="Submit">
            </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
