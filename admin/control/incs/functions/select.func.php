<?php

  function select($tbl, $where_rec, $equal) {
    global $conn;
    $get = $conn->prepare("SELECT * FROM `$tbl` WHERE `$where_rec` = ?");
    $get->execute(array($equal));
    return $get->fetch();
  }
