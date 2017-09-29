<?php

  function getTableData($tbl)
  {
    global $conn;
    $tbl_data = $conn->prepare("SELECT * FROM `$tbl`");
    $tbl_data->execute();
    return $tbl_data->fetchAll();
  }
