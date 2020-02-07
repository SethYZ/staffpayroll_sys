<?php

// Get values from loginform.html
  $username = $POST['username'];
  $password = $POST['password'];

// Prevent mysql injection to crash databases
  $username = stripcslashes($username);
  $password = stripcslashes($password);
  $username = mysql_real_escape_string($username);
  $password = mysql_real_escape_string($password);

// Connecting to the users databases
  mysql_connect("localhost", "root", "");
  mysql_select_db("userlogin");

// Query data from the database for users
  $result = mysql_query("SELECT * from users WHERE username = '$username' AND '$password'")
            or die("Failed to login" .mysql_error());

  $row = mysql_fetch_array($result);
  if ($row['username'] == $username && $row['password'] == $password){
    echo "Welcome " .$row['username'];
  }
  else{
    echo "Wrong Username/Password combination. ";
  }

?>
