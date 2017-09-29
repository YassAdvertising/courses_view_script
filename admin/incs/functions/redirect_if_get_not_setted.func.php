<?php

  function redirectGET($__get, $redirect_to)
  {
    $__get == $redirect_to;
    if (!isset($_GET[$__get])) {
      header('Location: ' . $redirect_to);
    }
  }
