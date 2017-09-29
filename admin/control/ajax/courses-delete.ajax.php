<?php
  session_start();
  require_once('../incs/all/config.php');
  require('../incs/all/connection.php');

  if ($_POST['accept-delete'] == '1') {
    $cou_id = $_POST['course_id'];
    $delete_cou = $conn->prepare("DELETE FROM courses WHERE CourseID = ?");
    $delete_cou->execute(array($cou_id));
    if ($delete_cou) {
      echo "<script>setTimeout(function () { location.href = '?control=manage'; }, 0);";
    }
  }
