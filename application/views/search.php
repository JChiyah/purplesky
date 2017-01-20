<div id="search">
   <h1>Search and Apply</h1>

   <div class="container">
      <p>Search and apply for any current or future projects within the organisation</p>
      <section id="quick-search">
         <form action="" method="post">
            <input type="text" name="" value="">
            <input type="submit" name="" value="Quick Search" id="">
         </form>
      </section>
      
      <button id="show-search">Open Advanced Search</button>

      <section id="advanced-search">
         <h2>Advanced search</h2>
         <hr>
         <form action="" method="post">
            <div id="col-sm-12 col-md-6">
               <p>
                  <label id="projectInput">Project:</label> <br>
                  <input type="text" name="" value="">
               </p>         
               <p>
                  <label>From:</label>
                  <input type="date" name="" value="">
               </p>
               <p>
                  <label>To:</label>
                  <input type="date" name="" value="">
               </p>
            </div>
            <div id="col-sm-12 col-md-6">
               <p>
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
            </div>
            <input type="submit" name="advSearch" value="Search">
         </form>
      </section>
   </div>

   <section id="search-results">
      <h2>Results:</h2>
      <div class="col-xs-12 col-sm-8 col-md-6">
        <label>Order by:</label>
        <select name="orderBy">
          <!--TODO:: find grouping selections-->
          <option value="dailyRate">Date</option>
          <option value="location">Locations</option>
        </select>
      </div>
      <hr>
   </section>

</div>
