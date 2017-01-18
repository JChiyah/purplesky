<div id="search">
  <div class="container">
    <h1>Search and Apply</h1>
    <p></p>
    <div class="row" id="searchContainer">
     <p>Search and apply for any current or future projects within the organisation</p>

      <div class="col-xs-12 col-sm-8 col-md-4" id="quickSearchBox">
        <form class="" action="index.html" method="post" >
          <input type="text" name="quickSearch" value="" >
           <input type="submit" name="quickSearchBTN" value="Quick Search" >
        </form>
       
      </div>
    </div>
    <p></p>
    <h2>Advanced search:</h2>
    <hr>
    <p></p>
    <div id="searchContainer">
      <form class="" action="index.html" method="post">
        <div class="row"> <!--Project and location begin-->
          <div class="col-xs-12 col-sm-8 col-md-6">
            <label>Project:</label> <br>
            <input type="text" name="projectName" value="">
            <p></p>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-6">
            <label>Location:</label> <br>
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
            <label>From:</label>
            <input type="date" name="fromDate" value="DD/MM/YYYY">
            <p></p>
            <label>To:</label>
            <input type="date" name="toDate" value="DD/MM/YYYY">
            <p></p>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-6">
            <label>Keywords:</label> <br>
            <input type="text" name="keywards" value="">
            <p></p>
          </div>
        </div> <!--dates and keywards begin-->
        <input type="submit" name="advSearch" value="Search" id="AdvancedSearchButton">
      </form>
    </div>
    <p></p>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-6">
        <h2>Results:</h2>
      </div>
      <div class="col-xs-12 col-sm-8 col-md-6" id="order" >
        <label>Order by:</label>
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
</div>
