<?php

  /** Configuration File
   * Please Before Starting Your Project Fill Up Connection Informations
   * Fill [username] Of Database
   * Fill [password] Of Database
   * Fill [database_name]
   * Put Your Options
   * Connection Using PDO
  */

  $db_username  = 'root';            # Database Username
  $db_name      = 'resume';          # Database Name
  $db_password  = '';                # Database Password
  $host_name    = 'localhost';       # Host Name
  $conn_options = [                  # Connection Options
    PDO::ATTR_ERRMODE                 => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND      => 'SET NAMES utf8'
  ];
  $dsn          = "mysql:host=$host_name;dbname=$db_name"; # Data Source Name
