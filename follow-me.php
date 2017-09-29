<?php
  session_start();
  $page_title         = 'Courses Creator';
  $meta_desc          = 'Mostafa All Accounts';
  $meta_keywords      = 'Social Media, Mostafa Ali, Contact, Follow me';
  include('incs/all.php');
  /* Fetch Data Of Controller */
  $controller = $conn->prepare("SELECT * FROM controller");
  $controller->execute();
  $controller_data = $controller->fetchAll();
  run_css("body { background-color: #F3F3F3; } .navbar-main { background-color: #111 !important; }");
?>

  <!-- Controller ID -->
  <?php foreach ($controller_data as $con_id) { ?>
    <div class="controller">
      <div class='container'>
        <div class="controller-header">
          <h3><?php echo $con_id['ControllerName']; ?></h3>
        </div>
        <div class='controller-content'>
          <br><h2 class='center gray _100 light'>Social Media Of <?php echo "<span>" . $con_id['ControllerName'] . "</span>"; ?></h2>
          <hr><br>
          <h3><a href='<?php echo $con_id['Controller_FB']; ?>' target='_blank'><i class='fa fa-facebook-square fa-fw'></i> Facebook</a></h3>
          <h3><a href='<?php echo $con_id['Controller_Twitter']; ?>' target='_blank'><i class='fa fa-twitter fa-fw'></i> Twitter</a></h3>
          <h3><a href='<?php echo $con_id['Controller_YouTube']; ?>' target='_blank'><i class='fa fa-google fa-fw'></i> Google+</a></h3>
          <h3><a href='<?php echo $con_id['Controller_YouTube']; ?>' target='_blank'><i class='fa fa-youtube fa-fw'></i> YouTube</a></h3>
          <h3><a href='<?php echo $con_id['Controller_Instagram']; ?>' target='_blank'><i class='fa fa-instagram fa-fw'></i> Instagram</a></h3><br>
        </div>
      </div>
    </div>
  <?php } ?>
<?php include($paths['all_important_files'] . 'footer.php'); ?>
