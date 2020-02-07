<?php include('serverconfig.php'); ?>

<!DOCTYPE HTML>

<html>

<head>
  <title>Welcome Page</title>
  <link rel="stylesheet" href="mainstylesheet.css">
</head>

<body>

  <div class="content">

    <?php if (isset($_SESSION['success'])): ?>
      <div class="error success">
        <h3>
          <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
           ?>
        </h3>
      </div>
    <?php endif ?>

    <div class="header">
      <h2>Home Page</h2>
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

</body>


</html>
