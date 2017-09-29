<?php

  function count_recs($table)
  {
    global $conn;
    $count = $conn->prepare("SELECT * FROM `$table`");
    $count->execute();
    $count_data = $count->fetchAll();
    return count($count_data);
  }
