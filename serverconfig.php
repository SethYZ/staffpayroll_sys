<?php
  session_start();

  $firstname = "";
  $lastname = "";
  $username = "";
  $position = "";
  $_SESSION['capnum'] = ((isset($_SESSION['capnum'])) ? $_SESSION['capnum'] : 0);

  $_SESSION['basic_salary'] = isset($_SESSION['basic_salary']) ? $_SESSION['basic_salary'] : "0";

  // Set default value
  $_SESSION['amountrequest'] = isset($_SESSION['amountrequest']) ? $_SESSION['amountrequest'] : "0";
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

        $registeremployeeinfo = "INSERT INTO employeeinfo (firstname, lastname, department, position
                                ,username, password)
                                  VALUES ('$firstname', '$lastname', '$department', '$position',
                                '$username', '$password_1')";
        mysqli_query($link1, $registeremployeeinfo);

        $_SESSION['success'] = "Registration completed!";

        header('location: index.php');
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
    	$query = "SELECT * FROM employeeinfo WHERE username='$username' AND password='$password'";
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
      header('location: index.php');
    }

  // Calculate salary

  $hours_worked = "";
  $wageperhour = "";

  if(isset($_POST['updatesalarybutton'])){
    $hours_worked = $_POST['hours_worked'];
    $wageperhour = $_POST['wageperhour'];

    if (empty($hours_worked) || (!is_numeric($hours_worked))) {
      array_push($errors, "Hours Worked/Number is required");
    }

    if (empty($wageperhour) || (!is_numeric($wageperhour))) {
      array_push($errors, "Wage per Hour/Number is required");
    }

    if (count($errors) == 0) {
        $basic_salary = $hours_worked * $wageperhour;

        $querysalary = "UPDATE salary SET current_basic_salary = '$basic_salary'";
        mysqli_query($link1, $querysalary);
        $_SESSION['basic_salary'] = $basic_salary;

        header('refresh:1; url=salary.php');
    }
  }

  // When request button is pressed

  if(isset($_POST['requestbutton'])){
    $amountrequest = $_POST['requestamount'];

    if (empty($amountrequest) || (!is_numeric($amountrequest))) {
      array_push($errors, "Amount Requested/Number is required");
    }

    if (count($errors) == 0) {

      $newbasic_salary = $_SESSION['basic_salary'];

      if ($_SESSION['basic_salary'] > $amountrequest){
          $requeststatus = "success";
      }
      else{
          $requeststatus = "failed";
      }

        $_SESSION['capnum']++;

          if ($requeststatus == "success"){
              $_SESSION['basic_salary'] = $_SESSION['basic_salary'] - $amountrequest;
          }

        $amountrequestquery = ("INSERT INTO salary (ref_id, username, current_basic_salary, requestamount, requeststatus)
                                VALUES ('". $_SESSION['capnum'] ."', '". $_SESSION['username'] ."', '". $_SESSION['basic_salary'] ."',
                                  '$amountrequest', '$requeststatus')");
        mysqli_query($link1, $amountrequestquery);

        $_SESSION['request_sent'] = "requestout.";

        header('refresh:1; url=salary.php');
    }

  }

mysqli_close($link1);
?>
