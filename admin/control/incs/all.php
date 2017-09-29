<?php

  $paths = [
    'css'                   => 'layout/css/',
    'js'                    => 'layout/js/',
    'pictures'              => 'layout/pictures/',
    'incs'                  => 'incs/',
    'func'                  => 'incs/functions/',
    'oop'                   => 'incs/oop/',
    'AIF'                   => 'incs/all/'
  ];

  // Object Oriented Programming - OOP Files
  foreach (glob('html/hhh.class.php') as $class_file) {
    include($class_file);
  }

  // Functions Files
  foreach (glob($paths['func'] . '*.func.php') as $class_file) {
    include($class_file);
  }

  // Important Files
  foreach (glob($paths['AIF'] . '*.php') as $impor_file) {
    include($impor_file);
  }
