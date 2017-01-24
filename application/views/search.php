<div id="search">
   <h1>Search for Projects</h1>

   <div class="container-box">
      <section id="quick-search">
         <?php global $user_group; if ($user_group != 1 && $user_group != 2) 
            { echo '<p>Search for any current or future projects within the organisation</p>'; } else echo '<p>Search and apply for any current or future projects within the organisation</p>'; ?>
         <form action="" method="post">
            <input type="text" name="" value="" placeholder="Enter keyword, project title or manager name">
            <input type="submit" name="" value="Search" id="">

            <div id="advanced-search">
               <hr>
               <p>You can fill in as many details as you want</p>
               <div class="container-fluid">
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
                  <div class="col-sm-12 col-md-6">
                     <p>
                        <label>Location:</label> <br>
                        <select name="location">
                           <option value="select">Any</option>
                           <option value="test 1">Test 1</option>
                           <option value="test 2">Test 2</option>
                        </select>
                     </p>
                     <p>
                        <label>Onsite</label>
                        <input type="checkbox" name="" value="onsite" checked>
                     </p>
                  </div>
               </div>
            </div>

         </form>
      </section>

      <button id="search-toggle">Open Advanced Search</button>
   </div>

   <section class="hidden" id="search-results">
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
