<?php
  session_start();
  require_once('../incs/all/config.php');
  require('../incs/all/connection.php');

  if ($_POST['accept-delete'] == '1') {
    $us_id = $_POST['user_id'];
    $delete_user = $conn->prepare("DELETE FROM users WHERE UserID = ?");
    $delete_user->execute(array($us_id));
    if ($delete_user) {
      echo "<script>setTimeout(function () { location.href = '?control=manage'; }, 0);";
    }
  }
