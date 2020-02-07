<?php
  session_start();

  $firstname = "";
  $lastname = "";
  $username = "";
  $position = "";
  $errors = array();


  // Connect to database
  $link1 = mysqli_connect('localhost', 'root', '', 'employee');

  // If the register button is clicked
  if (isset($_POST['registerbutton'])){
    $firstname = mysqli_real_escape_string($link1, $_POST['fname']);
    $lastname = mysqli_real_escape_string($link1, $_POST['lname']);
    $username = mysqli_real_escape_string($link1, $_POST['username']);
    $password_1 = mysqli_real_escape_string($link1, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($link1, $_POST['password_2']);
    $department = mysqli_real_escape_string($link1, $_POST['department']);
    $position = mysqli_real_escape_string($link1, $_POST['position']);

    // Ensure that the field is filled
    if (empty($firstname)){
      array_push($errors, "First name is required");
    }

    if (empty($lastname)){
      array_push($errors, "Last name is required");
    }

    if (empty($username)){
      array_push($errors, "Username is required");
    }

    if (empty($department)){
      array_push($errors, "Choose one department");
    }

    if (empty($position)){
      array_push($errors, "Position is required");
    }

    if (empty($password_1)){
      array_push($errors, "Password field cannot be empty");
    }

    if (empty($password_2)){
      array_push($errors, "Confirm Password field cannot be empty");
    }

    if(!empty($password_1 && $password_2)){
      if ($password_1 != $password_2){
        array_push($errors, "Password and Confirm Password field do not match");
      }
    }

    // Check if the username or the name already been registered or not

    $username_check_query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($link1, $username_check_query);
    $num = mysqli_num_rows($result);

    // if user exists
      if ($num == 1) {
        array_push($errors, "Username already exists");
      }

    // If there is no errors then save the information into the database.
      if(count($errors) == 0){
        $registeruser = "INSERT INTO users (username, password)
                          VALUES ('$username', '$password_1')";
        mysqli_query($link1, $registeruser);

        $registeremployeeinfo = "INSERT INTO employeeinfo (firstname, lastname, department, position)
                                  VALUES ('$firstname', '$lastname', '$department', '$position')";
        mysqli_query($link1, $registeremployeeinfo);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Registration completed!";

        header('location: homepage.php');

      }
  }

  // If Login button is pressed

  if (isset($_POST['loginbutton'])) {
    $username = mysqli_real_escape_string($link1, $_POST['username']);
    $password = mysqli_real_escape_string($link1, $_POST['password']);

    if (empty($username)) {
    	array_push($errors, "Username is required");
    }
    if (empty($password)) {
    	array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
    	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    	$loginresult = mysqli_query($link1, $query);
    	if (mysqli_num_rows($loginresult) == 1) {
    	  $_SESSION['username'] = $username;
    	  header('location: homepage.php');
    	}else {
    		array_push($errors, "Wrong username/password combination");
    	}
    }
  }

  //logout

    if(isset($_GET['logout'])) {
      session_destroy();
      unset($_SESSION['username']);
      header('location: index.php');
    }

?>
