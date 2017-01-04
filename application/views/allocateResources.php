
<div class="container">

  <h1>Create New Project</h1>

  <div class="row"> <!--Allocate resources begin-->
    <h3>Step 2: Allocate Resources</h3>
    <hr>
    <div class="col-xs-12 col-sm-6 col-md-12">
      Please fill out at least one of the reqired feilds marked with an asterisk
      <p></p>
      <form class="" action="index.html" method="post">
        <div class="row"> <!--Skills and employee name-->
          <div class="col-xs-12 col-sm-3 col-md-6">
            *Skills: <br>
            <input type="text" name="skills" value="Type skills here..." required>
            <!--TODO:: add button function with plus sign glyphy-->
            <p></p>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-6">
            Employee Name: <br>
            <input type="text" name="employeeName" value="" required>
            <p></p>
          </div>
        </div> <!--Skills and employe end-->
        <div class="row"> <!--Location and rate-->
          <div class="col-xs-12 col-sm-3 col-md-6">
            *Are employees required to be on locations?
            <p></p>
            <input type="radio" name="onSite" value="yes" checked>Yes
            <input type="radio" name="onSite" value="no">no
            <p></p>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-6">
            Max. Daily Rate:
            <select name="payRate">
              <!--TODO::Double check if this is a drop down selection and what values should be represented-->
              <option value="500">£500</option><!--Find a better way to display constant '£' symbol-->
              <option value="400">£400</option>
            </select>
            <p></p>
          </div>
        </div> <!--location and rate end-->
        <div class="row"> <!--Time and Submit-->
          <div class="col-xs-12 col-sm-3 col-md-6">
            *From:
            <input type="date" name="fromDate" value="DD/MM/YYYY" required>
            <p></p>
            *To:
            <input type="date" name="toDate" value="DD/MM/YYYY" required>
            <p></p>
            </div>
          <div class="col-xs-12 col-sm-3 col-md-6">
            <input type="submit" name="submit" value="Submit">
          </div>
        </div> <!--Time and submit end-->
      </form>
    </div>
  </div>  <!--Allocate resources block end-->
  <p></p>
  <br>
  <div class="row"> <!--Results and added block-->
    <div class="col-xs-12 col-sm-3 col-md-6">
      Results:
      Order by:
      <select name="orderBy">
        <!--TODO:: find grouping selections-->
        <option value="dailyRate">Daily Rate</option>
        <option value="location">Locations</option>
      </select>
      <hr>
      Employee A: <hr>
      Employee B: <hr>
    </div>
    <!--
    TODO:: list
    1. css for verticle line to split the results and added blocks
    2.Ask exactly how to display results for both sections (nested col classes?)
    or a table just to display data?
    3.requires use of both add and remove glihy button
    4.how exactly do we plan on loading more results? extnding the page or replacing current results
    -->
    <div class="col-xs-12 col-sm-3 col-md-6">
      Added: <hr>
      Emplyee A: <hr>
      Employee B: <hr>
    </div>
    <input type="submit" name="Load" value="Load more results">
  </div> <!--Results and added block end-->
</div><!--container end-->
