<?php
  session_start();
  include('incs/all/connection.php');

  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashpass = sha1($password);

  $errors = [];

  if (empty($username)) { $errors[] = 'Username is required, Please fill up your username'; }
  if (empty($password)) { $errors[] = 'Please fill your admin password !'; }

  foreach ($errors as $error) {
    echo "<div class='alert error'>$error</div>";
  }

  if (empty($errors)) {

    $search_controller = $conn->prepare('SELECT * FROM controller WHERE Controller_Username = ? And Controller_Password = ?');
    $search_controller->execute(array($username, $hashpass));
    $admin_data = $search_controller->fetch();
    if ($search_controller->rowCount() > 0) {
      $_SESSION['admin_id'] = $admin_data['ControllerID'];
      echo "<div class='alert success'>Your admin account has been found! Redirecting...</div>";
      echo "<script>setTimeout(function () { window.location.href = 'control/'; }, 3500);</script>";
    } else {
      echo "<div class='alert error'>Username or password is incorrect</div>";
    }

  }
