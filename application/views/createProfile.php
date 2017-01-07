<div class="container">
  <h1>Create Profile</h1>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-12"><sub>Please fill out all fields</sub>
      <form class="" action="index.html" method="post">
        Title: <br>
        <select name="title" required>
          <option value="Mr.">Mr.</option>
          <option value="Mrs.">Mrs.</option>
          <!--TODO::What other titiles are in list?-->
        </select>
        <p></p>
        First Name: <br>
        <input type="text" name="firstName" value="" required>
        <p></p>
        Surname: <br>
        <input type="text" name="surname" value="" required>
        <p></p>
        Email:<br>
        <input type="email" name="email" value="exampleemail@hotmail.com" required>
        <p></p>
        Choose password: <br>
        <input type="text" name="password" value="password" required>
        <p></p>
        Re-type password: <br>
        <input type="text" name="rePassword" value="password" required>
        <p></p>
        Location: <br>
        <select name="location" required>
          <option value="test1">Test1</option>
          <option value="test2">Test2</option>
        </select>
        <input type="submit" name="submit" value="Submit">
      </form>
    </div>
  </div>
</div>
