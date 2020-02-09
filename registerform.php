<?php include('serverconfig.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <br><br>
  <title>Register Here</title>
  <link rel="stylesheet" href="mainstylesheet.css">

</head>

  <body style="background-color: grey">

    <div class="registerpage">
      <br><center><h2>Get Started Here</h2></center><br>
      <!-- Display Error validation -->
      <?php include('errors.php') ?>

    <form class="registerform" action="registerform.php" method="post">

      <div class="namediv">
        <br><br><label><b>First name:</b></label>
        <input type="text" name="fname" class="inputinfo" value="<?php echo $firstname; ?>" placeholder="FIRST NAME"/>
        <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Last name:</b></label>
        <input type="text" name="lname" class="inputinfo" value="<?php echo $lastname; ?>" placeholder="LAST NAME"/><br>
      </div>

      <div class="usernamediv">
        <br><label><b>Username:</b></label>
        <input type="text" name="username" class="usernameinput" value="<?php echo $username; ?>" placeholder="USERNAME"/><br><br>
      </div>

      <div class="passworddiv">
        <label><b>Password:</b></label>
        <input type="password" name="password_1" class="inputinfo" placeholder="PASSWORD"/>
        <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspConfirm Password:</b></label>
        <input type="password" name="password_2" class="confirmpassinput" placeholder="PASSWORD"/><br><br>
      </div>

      <div class="departmentdiv">

        <label><b>Department:</b></label>
        <select name="department" class="departmentinput">
          <option selected value="">Select Department</option>
          <option value="hr">Human Resources</option>
          <option value="it">Information Technology</option>
          <option value="finance">Finance</option>
          <option value="marketing">Marketing</option>
        </select>

        <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                  Position:</b></label>
        <input type="text" name="position" class="positioninput"
        value="<?php echo $position; ?>" placeholder="POSITION"/><br><br>

      </div>

        <input type="submit" id="registerbtn" name="registerbutton" value="Register"/><br>
        <a href="index.php"><input type="button" id="returnbtn" value="<<-- Back"/></a><br>

        <p>Already a member?<a href=loginform.php>Sign in</a></p>
    </form>

    </div>

  </body>

</html>
