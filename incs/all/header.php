<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php title(); ?></title>
  <link rel='stylesheet' href='<?php echo $paths['css'] . 'resets.css'; ?>'>
  <link rel='stylesheet' href='<?php echo $paths['css'] . 'font-awesome.min.css'; ?>'>
  <link rel='stylesheet' href='<?php echo $paths['css'] . 'nav.css'; ?>'>
  <link rel='stylesheet' href='<?php echo $paths['css'] . 'main.css'; ?>'>
  <!-- Meta Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
    meta_desc();
    meta_author(); echo "\n";
    meta_keywords(); echo "\n";
  ?>
</head>
<body>
