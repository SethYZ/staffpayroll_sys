<?php include('serverconfig.php'); ?>

<!DOCTYPE HTML>

<html>

<head>
  <title>Request Status</title>
  <link rel="stylesheet" href="mainstylesheet.css">
  <script src="https://kit.fontawesome.com/58fb0d3b26.js"></script>

  </script>
</head>

<body>

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
    </div>
  </div>


      <?php if(isset($_SESSION["username"])): ?>
          <div class="logoutdiv">
              <br><img src="image/user-profile-avatar-icon.jpg" height="45px" width="45px"/>
              <p>Welcome, <b><?php echo $_SESSION['username']; ?></b>
              <a href="index.php?logout='1'" style="color: aqua;">Logout</a>
              </p>
      <?php endif ?>

          </div>

</body>


</html>
