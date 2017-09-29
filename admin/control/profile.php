<?php
  session_start();
  $page_title = 'Profile';
  include('incs/all.php');
  $getControllerData = getTableData('controller', 'ControllerID', $_SESSION['admin_id'], 'ControllerName');
  run_css('body { background-color: #f1f1f1; }');

  // Get Latest 3 Recorder Of All Tables
  function getLatest($table, $number_of_last_recorders, $order_by)
  {
    global $conn;
    $getLatest = $conn->prepare("SELECT * FROM `$table` ORDER BY `$order_by` LIMIT $number_of_last_recorders");
    $getLatest->execute();
    return $getLatest->fetchAll();
  }

  $latest_users   = getLatest('users', 3, 'UserID');
  $latest_courses = getLatest('courses', 3, 'CourseID');
  $latest_msgs    = getLatest('messages', 3, 'MessageID');
  $latest_controllerss = $conn->prepare("SELECT * FROM controller WHERE ControllerID != ? ORDER BY ControllerID LIMIT 3");
  $latest_controllerss->execute(array($_SESSION['admin_id']));
  $latest_controllers = $latest_controllerss->fetchAll();
?>


  <?php if (!isset($_GET['edit-profile'])) { ?>
    <div class="profile">
      <div class="profile-left">

        <div class="first">
          <h2><?php echo $adminData['ControllerName']; ?></h2>
          <span><a href='profile.php'>@<?php echo $adminData['Controller_Username'] ?></a></span>
          <a href="?edit-profile=true" class='btn btn-default'>Edit informations</a>
        </div>

        <div class="bottom">
          <h3>Informations</h3>
          <div class="content">
            <h4><i class='fa fa-newspaper-o'></i> Job: <?php echo $adminData['Job']; ?></h4>
            <h4><i class='fa fa-id-card'></i> College: <?php echo $adminData['College']; ?></h4>
            <h4><i class='fa fa-envelope'></i> Email: <?php echo $adminData['Controller_Email']; ?></h4>
          </div>
        </div>

      </div>
      <article class="profile-right">
        <h1>Latest news</h1>
        <section class="latest">
          <!-- Latest Usres -->
          <section>
            <div class="header" onclick='$(".profile-right .co1").slideToggle();'>
              <h3>Latest Users <i class='fa fa-plus'></i></h3>
            </div>
            <div class="content co1">
              <?php if (count($latest_users) == 0) { error_msg("No Any Latest User"); exit; } ?>
              <?php foreach ($latest_users as $user_re_da): ?>
                <h3><?php echo $user_re_da['Fullname']; ?></h3>
                <span>@<?php echo $user_re_da['Username']; ?></span>
              <?php endforeach; ?>
            </div>
          </section>

          <!-- Latest Controllers -->
          <section>
            <div class="header" onclick='$(".profile-right .co2").slideToggle();'>
              <h3>Latest Controllers <i class='fa fa-plus'></i></h3>
            </div>
            <div class="content co2">
              <?php if (count($latest_controllers) == 0) { error_msg("There's No any controller. Only you"); exit; } ?>
              <?php foreach ($latest_controllers as $con_re_da): ?>
                <h3><?php echo $con_re_da['ControllerName']; ?></h3>
                <span>@<?php echo $con_re_da['Controller_Username']; ?></span>
              <?php endforeach; ?>
            </div>
          </section>

          <!-- Latest Courses -->
          <section>
            <div class="header" onclick='$(".profile-right .co3").slideToggle();'>
              <h3>Latest Courses <i class='fa fa-plus'></i></h3>
            </div>
            <div class="content co3">
              <?php if (count($latest_courses) == 0) { error_msg("No Messages Were Sent"); exit; } ?>
              <?php foreach ($latest_courses as $cou_re_da): ?>
                <h3><?php echo $cou_re_da['CourseName']; ?></h3>
                <span><i class='fa fa-clock-o'></i> <?php echo $cou_re_da['CourseDate']; ?></span>
              <?php endforeach; ?>
            </div>
          </section>

          <!-- Latest Messages -->
          <section>
            <div class="header" onclick='$(".profile-right .co4").slideToggle();'>
              <h3>Latest Messages <i class='fa fa-plus'></i></h3>
            </div>
            <div class="content co4">
              <?php if (count($latest_msgs) == 0) { error_msg("No Messages Were Sent"); exit; } ?>
              <?php foreach ($latest_msgs as $msg_re_da): ?>
                <h3><strong>From: </strong> <?php echo $msg_re_da['MessageUsername']; ?></h3>
                <span><i class='fa fa-clock-o'></i> <?php $msg_date = explode(" ", $msg_re_da['MessageDate']); echo $msg_date[0]; ?></span>
              <?php endforeach; ?>
            </div>
          </section>

        </section>
      </article>
    </div>
  <?php } ?>

  <?php
    if (isset($_GET['edit-profile'])) {
      if ($_GET['edit-profile'] !== 'true') {
        exit;
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_new_username = $_POST['_new_username'];
        $_new_fullname = $_POST['_new_fullname'];
        $_new_email    = $_POST['_new_email'];
        $_new_password = $_POST['_new_password'];
        $s_new_password = sha1($_new_password);
        $_new_you      = $_POST['_new_you'];
        $_new_fb       = $_POST['_new_fb'];
        $_new_googlep  = $_POST['_new_googlep'];
        $_new_twitter  = $_POST['_new_twitter'];
        $_new_insta    = $_POST['_new_insta'];
        $_new_college  = $_POST['_new_college'];
        $_new_job      = $_POST['_new_job'];

        $edit_profile_errors = array();

        if (empty($_new_username)) { $edit_profile_errors[] = "Username can't be empty"; }
        if (empty($_new_email))    { $edit_profile_errors[] = "Email can't be empty"; }
        if (empty($_new_fullname)) { $edit_profile_errors[] = "Fullname can't be empty"; }
        if (empty($_new_password)) { $_new_password = $_POST['_old_password']; }
        if (empty($_new_you))      { $edit_profile_errors[] = "YouTube Channel can't be empty"; }
        if (empty($_new_fb))       { $edit_profile_errors[] = "Fb Account can't be empty"; }
        if (empty($_new_googlep))  { $edit_profile_errors[] = "Google+ Account can't be empty"; }
        if (empty($_new_twitter))  { $edit_profile_errors[] = "Twitter account can't be emtpy"; }
        if (empty($_new_insta))    { $edit_profile_errors[] = "Instagram Account can't be empty"; }
        if (empty($_new_college))  { $edit_profile_errors[] = "College can't be empty"; }
        if (empty($_new_job))      { $edit_profile_errors[] = "Job can't be empty"; }

        foreach ($edit_profile_errors as $epe) {
          error_msg($epr);
        }

        if (empty($edit_profile_errors)) {
          $con_ider = $adminData['ControllerID'];
          $edit_profile = $conn->prepare("UPDATE controller SET
          ControllerName = '$_new_fullname', Controller_Username = '$_new_username',
          Controller_Password = '$s_new_password', Controller_Email = '$_new_email',
          Controller_FB = '$_new_fb', Controller_YouTube = '$_new_you',
          Controller_GoogleP = '$_new_googlep', Controller_Twitter = '$_new_twitter',
          Controller_Instagram = '$_new_insta' WHERE ControllerID = " . $con_ider);
          $edit_profile->execute();
          if ($edit_profile->rowCount() > 0) {
            success_msg("Infomation Has been Updated successfully!");
          } else {
            error_msg("Can't Update information");
          }
        }

      }
  ?>
    <section class="edit-profile">
      <h1>Edit Your Information</h1>
      <form method="post">
        <input type="text" name="_new_username" placeholder="Your New Username" value="<?php echo $adminData['Controller_Username']; ?>">
        <input type="text" name="_new_fullname" placeholder="Your New Fullname" value="<?php echo $adminData['ControllerName']; ?>">
        <input type="email" name="_new_email" placeholder="Your New Email" value="<?php echo $adminData['Controller_Email']; ?>">
        <input type="hidden" name="_old_password" value="<?php echo $adminData['Controller_Password']; ?>">
        <input type="password" name="_new_password" placeholder="Your New Password">
        <input type="url" name="_new_you" placeholder="Your New YouTube Channel" value="<?php echo $adminData['Controller_YouTube']; ?>">
        <input type="url" name="_new_fb" placeholder="Your New FB Account" value="<?php echo $adminData['Controller_FB']; ?>">
        <input type="url" name="_new_googlep" placeholder="Your New Google+ Account" value="<?php echo $adminData['Controller_GoogleP']; ?>">
        <input type="url" name="_new_twitter" placeholder="Your New Twitter Account" value="<?php echo $adminData['Controller_Twitter']; ?>">
        <input type="url" name="_new_insta" placeholder="Your New Instagram Account" value="<?php echo $adminData['Controller_Instagram']; ?>">
        <input type="text" name="_new_college" placeholder="Your New College" value="<?php echo $adminData['College']; ?>">
        <input type="text" name="_new_job" placeholder="Your New Job" value="<?php echo $adminData['Job']; ?>">
        <button class="btn btn-dark">Finish Edit</button>
      </form>
    </section><br><br>
  <?php } ?>

<?php include($paths['AIF'] . 'footer.php'); ?>
