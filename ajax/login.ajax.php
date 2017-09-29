<?php
  session_start();
  require('../incs/all/connection.php');

  $account  = $_POST['account'];
  $password = $_POST['password'];
  $hpass    = sha1($password);

  $errors = array();

  if (empty($account))     { $errors[] = 'Please enter your username or email'; }
  if (empty($password))    { $errors[] = 'Please enter your account password'; }

  foreach ($errors as $error) {
    echo "<div class='alert error'>$error</div>";
  }

  if (empty($errors)) {
    $search_account = $conn->prepare("SELECT * FROM users WHERE Username = ? AND Password = ?");
    $search_account->execute(array(
      $account,
      $hpass
    ));
    $searchedData = $search_account->fetch();
    if ($search_account->rowCount() > 0) {
      $_SESSION['UserID'] = $searchedData['UserID'];
      echo "<div class='alert success'>Acccount Found. Redirecting.....</div>";
      echo "<script>setTimeout(function () { window.location.href = 'http://localhost/Resume'; }, 3500);</script>";
    } else {
      echo "<div class='alert error'>Username or Password incorrect</div>";
    }
  }
