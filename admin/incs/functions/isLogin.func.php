<?php

  function isLogined($session_name)
  {
    if (!isset($_SESSION[$session_name])) {
      redirect_js('index', 0);
    }
  }
