<?php

  function redirect_get_error($get, $error)
  {
    if (!isset($_GET[$get])) {
      error_msg($error);
      redirect_js('?control=manage', 2500);
      exit();
    }
  }
