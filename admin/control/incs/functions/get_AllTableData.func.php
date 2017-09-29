<?php

  function getTableData($tbl, $recorder, $equal_not, $orderby)
  {
    global $conn;
    $tbl_data = $conn->prepare("SELECT * FROM `$tbl` WHERE `$recorder` != ? ORDER BY '$orderby'");
    $tbl_data->execute(array($equal_not));
    return $tbl_data->fetchAll();
  }
