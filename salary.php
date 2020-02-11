<?php
include('serverconfig.php');
 ?>

<!DOCTYPE HTML>

<html>

<head>
  <title>Payroll Page</title>
  <link rel="stylesheet" href="mainstylesheet.css">
  <script src="https://kit.fontawesome.com/58fb0d3b26.js"></script>
  </script>
</head>

<body>

  <?php if (isset($_SESSION['request_sent'])): ?>
    <div class="requestsuccess">
        <?php
          echo '<script type="text/javascript"> window.onload = function(){
                  alert("Request Sent.");}
                </script>';
          unset($_SESSION['request_sent']);
         ?>
    </div>
  <?php endif ?>

  <div class="homepagebackground">
    <div class="content">

    <input type="checkbox" id="check"/>
    <label for="check">
      <i class="fas fa-bars" id="menubtn"></i>
        <i class="fas fa-times" id="cancelbtn"></i>
      </label>

      <div class="sidebar">
          <header>Payroll System</header>
          <ul>
            <li><a href="homepage.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="salary.php"><i class="fas fa-money-check-alt"></i>Salary</a></li>
            <li><a href="request.php"><i class="fas fa-tasks"></i>Request Status</a></li>
          </ul>
      </div>

    <div class="salarydiv">
      <br><br><header>
        <h2>Salary Page</h2>
      </header>

      <form class="salaryform" action="salary.php" method="post">

      <!-- Display Error validation -->
      <?php include('errors.php'); ?>

        <div class="hours_workedwagesdiv">
          <label><b>Hours Worked:</b></label>
          <input type="text" name="hours_worked" class="hours_workedinput" placeholder="HOURS_WORKED"/>
          <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspWage Rate(RM):</b></label>
          <input type="text" name="wageperhour" class="wagesinput" placeholder="WAGES RATE"/><br>
        </div>

        <div class="basicrequestsalarydiv">
          <label><b>Update salary(+/-):</b></label>
          <input type="text" name="updatesalary" class="basicsalaryinput"/>
          <label><b>Current salary:</b></label>
          <input type="text" name="basicsalary" class="basicsalaryinput" value="<?php echo $_SESSION['basic_salary']; ?>"/><br>
        </div>

        <div class="resetsubmitbtndiv">
          <input type="reset" id="resetbtn" name="resetsalarybutton" value="Reset"/>
          <input type="submit" id="updatebtn" name="updatesalarybutton" value="Update"/><br>
        </div>

        <div class="requestsalarydiv">
          <h2 style="border: solid">Request Salary</h2><br>
          <label><b>Amount to be requested:</b></label>
          <input type="text" name="requestamount" class="reqeuestsalaryinput"/><br>
          <input type="submit" id="requestbtn" name="requestbutton" value="Confirm"/>
        </div>

          </form>
    </div>

      <?php if(isset($_SESSION["username"])): ?>
          <div class="logoutdiv">
              <br><img src="image/user-profile-avatar-icon.jpg" height="45px" width="45px"/>
              <p>Welcome, <b><?php echo $_SESSION['username']; ?></b>
              <a href="index.php?logout='1'" style="color: aqua;">Logout</a>
              </p>
      <?php endif ?>

          </div>
        </div>
      </div>

</body>


</html>
