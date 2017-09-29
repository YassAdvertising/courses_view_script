<?php

  function getControllerData($session_name)
  {
    global $conn;
    $session_userid = $_SESSION[$session_name];
    $getData = $conn->prepare('SELECT * FROM controller WHERE ControllerID = ?');
    $getData->execute(array($session_userid));
    return $getData->fetch();
  }
