<?php
  session_start();
  $page_title         = 'About Me';
  $meta_desc          = 'I Am Ahmed Mostafa';
  $meta_keywords      = 'Msh 3arf';
  include('incs/all.php');
  run_css('.navbar-main { background-color: #111 !important; }');
?>

  <!-- About Me Page -->
    <h1 class='_100 light gray center mb-35 fs-50'>About us</h1>
    <div class="about">
      <div>
        <i class='fa fa-code fa-lg'></i>
        <h3>Full course</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor tempor incididunt ut labore et dolor</p>
      </div>
      <div>
        <i class='fa fa-envelope fa-lg'></i>
        <h3>Full course</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor tempor incididunt ut labore et dolor</p>
      </div>
      <div>
        <i class='fa fa-user fa-lg'></i>
        <h3>Full course</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor tempor incididunt ut labore et dolor</p>
      </div>
      <div>
        <i class='fa fa-lightbulb-o fa-lg'></i>
        <h3>Full course</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor tempor incididunt ut labore et dolor</p>
      </div>
    </div>

<?php include($paths['all_important_files'] . 'footer.php'); ?>
