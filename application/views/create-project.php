<div id="newProject">
   <div class="container">
      <h1>Create new Project</h1>
      <div class="row">
         <h2>Step 1: Project Details</h2>
         <hr>
         <div class="col-xs-12 col-sm-6 col-md-12" id="NPcontainer">
            <p>Please fill out all fields.</p>
            <form class="" action="index.html" method="post">
               <p>
                  <label>Title:</label> <br>
                  <input type="text" name="title" value="" required>
               </p>
               <p>
                  <label>Description:</label><br>
                  <textarea rows="5" cols="50" name="" value="" required></textarea>
               </p>
               <p>
                  <label>From:</label>
                  <input type="date" name="fromDate" value="DD/MM/YYYY">
               </p>
               <p>
                  <label>To:</label>
                  <input type="date" name="toDate" value="DD/MM/YYYY">
               </p>
               <p>
                  <label>Location:</label><br>
                  <select name="location">
                  <!--TODO pull data from database for drop down selection - need to validate input(required)-->
                    <option value="select">Select</option>
                    <option value="test 1">Test 1</option>
                    <option value="test 2">Test 2</option>
                  </select>
               </p>
               <!--TODO::fix css misplacment error-->
               <!--div class="row">
                 <div class="col-xs-12 col-sm-6 col-md-5"-->
               <p>
                  <label>Priority:</label> <br>
                  <select name="priority">
                     <option value="normal">Normal</option>
                     <option value="high">High</option>
                  </select>
               </p>

               <input type="submit" name="submit" value="continue">

            </form>
         </div>
      </div>
   </div>
</div>
