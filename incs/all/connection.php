<?php
  require_once('config.php');
  ## Try To Connect
  try
  {
    $conn = new PDO($dsn, $db_username, $db_password, $conn_options);
  }
  ## Refuesd To Connect
  catch (PDOException $msg)
  {
    echo($msg->getMessage());
  }
