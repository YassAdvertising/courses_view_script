<?php
  session_start();
  require('../incs/all/connection.php');
  $functions_path = '../incs/functions/';
  $classes_path   = '../incs/oop/';
  require($classes_path . 'validate.class.php');

  foreach (glob($functions_path . '*.func.php') as $function_file) {
    require($function_file);
  }

  $nusername = $_POST['username'];
  $npassword = $_POST['password'];
  $nemail    = $_POST['email'];
  $nfullname = $_POST['fullname'];
  $nskills   = $_POST['skills'];
  $ncollege  = $_POST['college'];
  $njobTitle = $_POST['jobTitle'];

  $validate = new Validate();

  // Validate Empty Fields
  $validate->is_empty($nusername, "Username is required");
  $validate->is_empty($npassword, "Password is required");
  $validate->is_empty($nemail, "Email Address is required");
  $validate->is_empty($nfullname, "Fullname is required");
  $validate->is_empty($nskills, "Skills is required");
  $validate->is_empty($ncollege, "College is required");
  $validate->is_empty($njobTitle, "Job Title is required");

  // Validate Max Length Of Fields
  $validate->max_length($nusername, 60, "Username must be less than 60 letters");
  $validate->max_length($npassword, 25, "Password must be less than 25 letters");
  $validate->max_length($nemail, 255, "Email Address must be less than 255 letters");
  $validate->max_length($nfullname, 90, "Fullname must be less than 90 letters");
  $validate->max_length($nskills, 500, "Skills must be less than 500 letters");
  $validate->max_length($ncollege, 50, "College must be less than 50 letters");
  $validate->max_length($njobTitle, 40, "Job Title must be less than 60 letters");

  // Validate Min Length Of Fields
  $validate->min_length($nusername, 5, "Username must be more than 5 letters");
  $validate->min_length($npassword, 6, "Password must be more than 6 letters");
  $validate->min_length($nemail, 5, "Email Address must be more than 5 letters");
  $validate->min_length($nfullname, 8, "Fullname must be more than 8 letters");
  $validate->min_length($ncollege, 2, "College must be more than 2 letters");
  $validate->min_length($njobTitle, 5, "Job Title must be more than 5 letters");

  $validate->show_errors();

  if (empty($errors)) {
    $validate->success_msg = 'Your Informations is good';
    success_msg($validate->success_msg);
    $user_da = getUserData('UserID');
    redirect_js('?Username=' . $user_da['Username'], 5000);
  }
