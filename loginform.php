<?php include('serverconfig.php'); ?>

<!DOCTYPE html>

<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="mainstylesheet.css">
  </head>

<body style="background-color: grey">

  <div class="mainstyling">
    <center><h2>Login</h2></center><br>

  <form class="loginform" action="loginform.php" method="post">
    <?php include('errors.php'); ?>
      <label><b>Username:</b></label><br>
      <input type="text" name="username" class="inputinfo" placeholder="USERNAME"/><br><br>

      <label><b>Password:</b></label><br>
      <input type="password" name="password" class="inputinfo" placeholder="PASSWORD"/><br>

      <input type="submit" id="loginbtn" name="loginbutton" value="Login"/><br>
      <a href="index.php"><input type="button" id="returnbtn" value="<<-- Back"/></a><br>

      <p>Not a member yet?<a href=registerform.php>Sign up</a></p>
  </form>

  </div>

</body>

</html>
