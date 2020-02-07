<?php
  session_start();

  $firstname = "";
  $lastname = "";
  $username = "";
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

    $username_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($link1, $username_check_query);

    // if user exists
      if ($result === $username) {
        array_push($errors, "Username already exists");
      }

    // If there is no errors then save the information into the database.
      if(count($errors) == 0){
        $registeruser = "INSERT INTO users (username, password)
                        VALUES ('$username', '$password_1')";
        mysqli_query($link1, $registeruser);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Registration completed!";
        header('location: welcome.php');

      }
  }
?>
