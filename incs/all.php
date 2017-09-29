<?php

  $paths = array(
    'css'                   => 'layout/css/',
    'js'                    => 'layout/js/',
    'pictures'              => 'layout/pictures/',
    'incs'                  => 'incs/',
    'func'                  => 'incs/functions/',
    'oop'                   => 'incs/oop/',
    'all_important_files'    => 'incs/all/'
  );

  // Object Oriented Programming - OOP Files
  foreach (glob($paths['oop'] . '*.class.php') as $class_file) {
    include($class_file);
  }

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
    include($paths['all_important_files'] . $one_file);
  }
