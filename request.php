<?php
include('serverconfig.php');
 ?>

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
            <li><a href="request.php" onclick="window.location.reload(true)"><i class="fas fa-tasks"></i>Request Status</a></li>
          </ul>
      </div>

      <?php
          // Connect to database
          $conn = mysqli_connect('localhost', 'root', '', 'employee');

          // Write Query here
          $getdataquery = "SELECT * FROM salary";

          // Execute the Query
          $getdataresult = mysqli_query($conn, $getdataquery) or die( mysqli_error($conn));

          $table_format = "id='primarytable'";
      ?>


      <div class="requestdiv">
        <table style="border:2px solid white; color: white; font-size: 22px; margin-top: 20px; margin:0 auto;" border="1" cellspacing="3" cellpadding="3">
          <tr>
            <th>Reference ID</th>
            <th>Username</th>
            <th>Basic Salary</th>
            <th>Amount Requested</th>
            <th>Request Status</th>
          </tr>

          <?php
              while($row = mysqli_fetch_array($getdataresult)){
                  echo "<tr>";
                  echo "<td>" .$row['ref_id']. "</td>";
                  echo "<td>" .$row['username']. "</td>";
                  echo "<td>" .$row['current_basic_salary']. "</td>";
                  echo "<td>" .$row['requestamount']. "</td>";
                  echo "<td>" .$row['requeststatus']. "</td>";
                  echo "</tr>";
              }
          ?>

        </table>
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
