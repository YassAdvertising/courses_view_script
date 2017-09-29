<?php
  session_start();
  require_once('../incs/all/config.php');
  require('../incs/all/connection.php');

  if ($_POST['accept-delete'] == '1') {
    $controller_id = $_POST['controller_id'];
    $delete_con = $conn->prepare("DELETE FROM controller WHERE ControllerID = ?");
    $delete_con->execute(array($controller_id));
    if ($delete_con) {
      echo "<script>setTimeout(function () { location.href = '?control=manage'; }, 0);";
    }
  }
