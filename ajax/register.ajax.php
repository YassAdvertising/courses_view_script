<?php
  session_start();
  require('../incs/all/connection.php');

  $username = $_POST['username'];
  $password = $_POST['password'];
  $hpass    = sha1($password);
  $fullname = $_POST['fullname'];
  $email    = $_POST['email'];
  $college  = $_POST['college'];
  $jobTitle = $_POST['jobTitle'];

  $errors = array();

  if (empty($username)) { $errors[] = 'Please enter your Username'; }
  if (empty($password)) { $errors[] = 'Please enter your Password'; }
  if (empty($fullname)) { $errors[] = 'Please enter your Fullname'; }
  if (empty($email))    { $errors[] = 'Please enter your Email Address'; }
  if (empty($jobTitle)) { $errors[] = 'Please enter your Job Title'; }
  if (empty($college))  { $errors[] = 'Please enter your College'; }

  ## Strings Length
  if (strlen($username) <= 5 && !empty($username)) { $errors[] = 'Username must be more than 5 letters'; }
  if (strlen($password) <= 8 && !empty($password)) { $errors[] = 'Password must be more than 8 letters'; }
  if (strlen($fullname) <= 5 && !empty($fullname)) { $errors[] = 'Fullname must be more than 5 letters'; }

  $getUsername = $conn->prepare("SELECT Username FROM users WHERE Username = ?");
  $getUsername->execute(array($username));
  if ($getUsername->rowCount() > 0) {
    $errors[] = 'Username already exists please choose anthor';
  }

  foreach ($errors as $err) {
    echo "<div class='alert error reg-error'>$err</div>";
  }

  if (empty($errors)) {
    $insert_new_user = $conn->prepare("INSERT INTO users(Username, Password, Email, Fullname, College, Job) VALUES(?, ?, ?, ?, ?, ?)");
    $insert_new_user->execute(array($username, $hpass, $email, $fullname, $college, $jobTitle));
    $inserted_data = $conn->prepare('SELECT * FROM users WHERE Username = ?');
    $inserted_data->execute(array($username));
    $id = $inserted_data->fetch(); // id var mean inserted_data
    if ($insert_new_user->rowCount() > 0) {
      echo "<div class='reg-success alert success'>Your account has been created successfully. Redirecting....</div>";
      $_SESSION['UserID'] = $id['UserID'];
      echo "<script>setTimeout(function () { location.href = 'profile.php'; }, 2000);</script>";
    }
  }
