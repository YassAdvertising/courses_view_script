<?php
  session_start();
  $paths = array(
    'css'                   => 'layout/css/',
    'js'                    => 'layout/js/',
    'pictures'              => 'layout/pictures/',
    'incs'                  => 'incs/',
    'func'                  => 'incs/functions/',
    'oop'                   => 'incs/oop/',
    'AIF'                   => 'incs/all/' // (AIF) Mean [ All Important Files ]
  );

  // Functions Files
  foreach (glob($paths['func'] . '*.func.php') as $class_file) {
    include($class_file);
  }

  // Important Files
  $important_files = array(
    'connection.php',
    'header.php',
    'nav.php'
  );

  foreach ($important_files as $one_file) {
    include($paths['AIF'] . $one_file);
  }
