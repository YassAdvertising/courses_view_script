<?php

  function getUserData($session_name)
  {
    global $conn;
    $session_userid = $_SESSION[$session_name];
    $getData = $conn->prepare('SELECT * FROM users WHERE UserID = ?');
    $getData->execute(array($session_userid));
    return $getData->fetch();
  }
