<?php
  session_start();
  $page_title         = 'Create new account';
  $meta_desc          = 'New Account on Mostafa Ali Blog';
  $meta_keywords      = 'Registertion, New Account, Mostafa Ali';
  include('incs/all.php');
  run_css('body { background-color: #f6f6f6; } .navbar-main { background-color: #111 !important; }');
?>

  <!-- Create New Account Page -->
    <div class="new-account">
      <i class='fa fa-user-plus fa-3x mb-15 mt-15 gray'></i>
      <h2 class='_100 mb-15'>Get learning with free account!</h2>
      <div class="results"></div>
      <form onsubmit='return false' method="post">
        <input type="text" placeholder="Username">
        <input type="text" placeholder="Full name">
        <input type="password" placeholder="Password">
        <input type="email" placeholder="Email Address">
        <input type="text" placeholder="College">
        <input type="text" placeholder="Job Title">
        <button class='btn btn-primary'><i class='fa fa-user-plus fa-lg'></i> Create account</button>
        <div class="clearfix"></div>
        <a href="#"><i class='fa fa-question-circle'></i> Forget password ?</a><br>
      </form>
    </div>

<?php include($paths['all_important_files'] . 'footer.php'); ?>
