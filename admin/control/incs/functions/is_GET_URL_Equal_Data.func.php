<?php

  function check_url($__get, $equal_what)
  {
    if ($_GET[$__get] != $equal_what) {
      header('Location: error_pages/404');
    }
  }
