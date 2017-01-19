<div id="search">
   <h1>Search and Apply</h1>
   <p>Search and apply for any current or future projects within the organisation</p>
    <!--<h2>Search</h2> -->
   <section id="quick-search">

      <form action="" method="post">
         <input type="text" name="" value="">
         <input type="submit" name="" value="Quick Search" id="quick-search-button">
      </form>
   </section>
  <input type="submit" name="advSearch" value="Open Advanced Search" id="hideAdvancedSearch">
   
   <section id="advanced-search">
   <hr>
      <h2>Advanced search:</h2>
      <form action="" method="post">
      <div id="column1">
         <p>
            <label id="projectInput">Project:</label> <br>
            <input type="text" name="" value="">
         </p>
        
         <p>
            <label>From:</label>
            <input type="date" name="fromDate" value="DD/MM/YYYY">
         </p>
         <p>
            <label>To:</label>
            <input type="date" name="toDate" value="DD/MM/YYYY">
         </p>
         </div> 
         <div id="column2">  <p>
            <label id="locationInput">Location:</label> <br>
            <select name="location">
               <!--TODO pull data from database for drop down selection - need to validate input(required)-->
               <option value="select">Select</option>
               <option value="test 1">Test 1</option>
               <option value="test 2">Test 2</option>
            </select>
         </p>
         <p>
            <label>Keywords:</label> <br>
            <input type="text" name="keywards" value="">
         </p>
         <br>
         <br>
         <br>
         <br>

         </div>

         <input type="submit" name="advSearch" value="Search" id="submitAdvancedSearch">
      </form>
       
   </section>

   <section id="search-results">
      <h2 id="resultsTitle">Results:</h2>
      <div class="col-xs-12 col-sm-8 col-md-6" id="resultsSorting">
      
        <label >Order by:</label>
        <select name="orderBy">
          <!--TODO:: find grouping selections-->
          <option value="dailyRate">Date</option>
          <option value="location">Locations</option>
        </select>
      </div>
     
   </section>
    <hr> 
</div>
