<?php

  function redirect_js($to, $seconds)
  {
    run_js("setTimeout(function () { window.location.href = '$to'; }, $seconds);");
  }
