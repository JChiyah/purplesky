<!--TODO::How to display results-->
<div class="container">
  <h1>Search and Apply</h1>
  <p></p>
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-8">
      Search and apply for any current or future projects within the organisation
      <br>
      <input type="text" name="quickSearch" value="">
    </div>
    <div class="col-xs-12 col-sm-8 col-md-4">
      <p></p>
      <input type="submit" name="quickSearchBTN" value="Quick Search">
    </div>
  </div>
  <p></p>
  <h1>Advanced search:</h1>
  <hr>
  <p></p>
  <form class="" action="index.html" method="post">
    <div class="row"> <!--Project and location begin-->
      <div class="col-xs-12 col-sm-8 col-md-6">
        Project: <br>
        <input type="text" name="projectName" value="" required>
        <p></p>
      </div>
      <div class="col-xs-12 col-sm-8 col-md-6">
        Location: <br>
        <select name="location">
          <!--TODO pull data from database for drop down selection - need to validate input(required)-->
          <option value="select">Select</option>
          <option value="test 1">Test 1</option>
          <option value="test 2">Test 2</option>
        </select>
        <p></p>
      </div>
    </div><!--Project and location end-->
    <div class="row"> <!--dates and keywards begin-->
      <div class="col-xs-12 col-sm-8 col-md-6">
        From:
        <input type="date" name="fromDate" value="DD/MM/YYYY" required>
        <p></p>
        To:
        <input type="date" name="toDate" value="DD/MM/YYYY" required>
        <p></p>
      </div>
      <div class="col-xs-12 col-sm-8 col-md-6">
        Keywords: <br>
        <input type="text" name="keywards" value="">
        <p></p>
      </div>
    </div> <!--dates and keywards begin-->
    <input type="submit" name="advSearch" value="Search">
  </form>
  <p></p>
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6">
      <h1>Results:</h1>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-6">
      Order by:
      <select name="orderBy">
        <!--TODO:: find grouping selections-->
        <option value="dailyRate">Date</option>
        <option value="location">Locations</option>
      </select>
    </div>
  </div>
  <hr>
  <p></p>
  <!--TODO:: how do we implement the results ?-->
</div><!--container end-->
