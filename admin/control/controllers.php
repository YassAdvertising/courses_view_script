<?php
  session_start();
  $page_title = 'Controllers';
  include('incs/all.php');
  redirectGET('control', '?control=manage');
  $getControllerData = getTableData('controller', 'ControllerID', $_SESSION['admin_id'], 'ControllerName');
?>

  <!-- Controllers Page -->

  <!-- Manage Page -->
  <?php if ($_GET['control'] == 'manage') { ?>
    <section class='controllers-manage'>
      <h1 class='center mt-15 mb-15'>All Controllers</h1>
      <?php if (count($getControllerData) == 0) { error_msg('There\'s no controllers, Only you! <a href="?control=new-controller">New Controller</a>'); exit; } ?>
      <table>
        <tr>
          <th>#</th>
          <th>Controller Name</th>
          <th>Controller Email</th>
          <th>Social Media</th>
          <th>Settings</th>
        </tr>
        <?php foreach ($getControllerData as $conData) { ?>
          <tr>
            <td><?php echo $conData['ControllerID']; ?></td>
            <td><?php echo $conData['ControllerName']; ?></td>
            <td><?php echo $conData['Controller_Email']; ?></td>
            <td class='social-media'>
              <a href="<?php echo $conData['Controller_FB'] ?>"><i class='fa fa-facebook' style='background-color: #3b5998'></i></a>
              <a href="<?php echo $conData['Controller_Twitter'] ?>"><i class='fa fa-twitter' style='background-color: #1da1f2'></i></a>
              <a href="<?php echo $conData['Controller_YouTube'] ?>"><i class='fa fa-youtube' style='background-color: #cd201f'></i></a>
              <a href="<?php echo $conData['Controller_GoogleP'] ?>"><i class='fa fa-google-plus' style='background-color: #dd4b39'></i></a>
              <a href="<?php echo $conData['Controller_Instagram'] ?>"><i class='fa fa-instagram' style='background-color: #405de6'></i></a>
            </td>
            <td>
              <a href="?control=delete&controller_id=<?php echo $conData['ControllerID']; ?>" class='btn btn-danger tooltip' text='Delete'><i class='fa fa-trash'></i></a>
              <a href="?control=edit&controller_id=<?php echo $conData['ControllerID']; ?>" class='btn btn-primary tooltip' text='Edit'><i class='fa fa-edit'></i></a>
              <a href="?control=no-control&action=view&controller_id=<?php echo $conData['ControllerID']; ?>" class='btn btn-warning tooltip' text='View'><i class='fa fa-eye'></i></a>
            </td>
          </tr>
        <?php } ?>
      </table>
      <a href="?control=new-controller" class='mt-15 ml-25' style='display: block;'><i class='fa fa-user-plus'></i> New Controller</a>
    </section>
  <?php } ?>

  <!-- Delete Page -->
  <?php if ($_GET['control'] == 'delete') { ?>
    <?php
      run_css('body { background-color: #F1F1F1; }');
      redirect_get_error('controller_id', 'There\'s no Controller Selected to delete !');
      $controller_data = select('controller', 'ControllerID', $_GET['controller_id']);
    ?>
    <div class="controllers-delete">
      <div class="result"></div>
      <input type='hidden' value='<?php echo $_GET['controller_id']; ?>' class='con-id'>
      <div class='confirm alert'>
        <span>Are you sure to delete this controller ?</span>
        <button class="material-button blue">Yes</button>
        <button class="material-button red cancel_del">Cancel</button>
      </div>
    </div>
  <?php } ?>

  <!-- View Controller Information -->
  <?php if ($_GET['control'] == 'no-control' && $_GET['action'] == 'view') { ?>
    <?php
      run_css('body { background-color: #F1F1F1; }');
      redirect_get_error('controller_id', 'There\'s no Controller Selected to view his information !');
      $conD = select('controller', 'ControllerID', $_GET['controller_id']);
      $dateController = explode(' ', $conD['JoinedIn']);
    ?>
    <section class="controller-view">
      <header>
        <?php
          $next_con = ++$_GET['controller_id'];
          $prev_con = $_GET['controller_id'] - 2;
          $select_con_next = $conn->prepare("SELECT ControllerID FROM controller WHERE ControllerID = ?");
          $select_con_next->execute(array($next_con));
          $rowCountNext = $select_con_next->rowCount();
          $select_con_prev = $conn->prepare("SELECT ControllerID FROM controller WHERE ControllerID = ?");
          $select_con_prev->execute(array($prev_con));
          $rowCountPrev = $select_con_prev->rowCount();
        ?>
        <?php if ($rowCountPrev > 0) { ?>
          <i class="material-icons" onclick=location.href="?control=no-control&action=view&controller_id=<?php echo $prev_con; ?>">arrow_back</i>
        <?php } ?>
        <?php if ($rowCountNext > 0) { ?>
          <i class="material-icons right" onclick=location.href="?control=no-control&action=view&controller_id=<?php echo $next_con; ?>">arrow_forward</i>
        <?php } ?>
      </header>
      <section class="content">
        <h1 class='_100'><?php echo $conD['ControllerName']; ?> - <span>@<?php echo $conD['Controller_Username']; ?></span></h1>
        <h2><i class='fa fa-clock-o'></i> <?php echo $dateController[0]; ?></h2>
        <h3 class='gray _100 mt-5'><i class='fa fa-envelope'></i> <?php echo $conD['Controller_Email']; ?></h3>
        <a href="<?php echo $conD['Controller_FB'] ?>"><i class='fa fa-facebook' style='background-color: #3b5998'></i></a>
        <a href="<?php echo $conD['Controller_Twitter'] ?>"><i class='fa fa-twitter' style='background-color: #1da1f2'></i></a>
        <a href="<?php echo $conD['Controller_YouTube'] ?>"><i class='fa fa-youtube' style='background-color: #cd201f'></i></a>
        <a href="<?php echo $conD['Controller_GoogleP'] ?>"><i class='fa fa-google-plus' style='background-color: #dd4b39'></i></a>
        <a href="<?php echo $conD['Controller_Instagram'] ?>"><i class='fa fa-instagram' style='background-color: #405de6'></i></a>
      </section>
    </section>
  <?php } ?>

  <!-- Controllers Edit Page -->
  <?php if ($_GET['control'] == 'edit') { ?>
    <?php
      $cud = select('controller', 'ControllerID', $_GET['controller_id']);
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $need_replace = array("'", '"', "&", "^", '%', "-", "+", "*", "!", "@", "#", "$", ">", "<", ",", "?", ":", ";", "`", "(", ")", ".");

        $newc_fullname     = str_replace($need_replace, "", $_POST['newc_fullname']);
        $newc_username     = str_replace($need_replace, "", $_POST['newc_username']);
        $newc_email        = $_POST['newc_email'];
        $newc_youchan      = $_POST['newc_youchan'];
        $newc_fb_acc       = $_POST['newc_fb_acc'];
        $newc_google_p     = $_POST['newc_google_p'];
        $newc_twitter      = $_POST['newc_twitter'];
        $newc_insta        = $_POST['newc_insta'];
        $newc_college      = str_replace($need_replace, "", $_POST['newc_college']);
        $newc_job          = str_replace($need_replace, "", $_POST['newc_job']);
        $newc_errors = array();

        if (empty($newc_fullname))    { $nc_errors[] = "Fullname can't Be Empty"; }
        if (empty($newc_username))    { $nc_errors[] = "Username can't Be Empty"; }
        if (empty($newc_email))       { $nc_errors[] = "Email can't Be Empty"; }
        if (empty($newc_youchan))     { $nc_errors[] = "Your YouTube Channel can't Be Empty"; }
        if (empty($newc_fb_acc))      { $nc_errors[] = "FB Account can't Be Empty"; }
        if (empty($newc_google_p))    { $nc_errors[] = "Google+ Account can't Be Empty"; }
        if (empty($newc_twitter))     { $nc_errors[] = "Twitter Account can't Be Empty"; }
        if (empty($newc_insta))       { $nc_errors[] = "Instagram Account can't Be Empty"; }
        if (empty($newc_college))     { $nc_errors[] = "College can't Be Empty"; }
        if (empty($newc_job))         { $nc_errors[] = "Job Title can't Be Empty"; }

        if (strlen($newc_fullname) > 5)   { $nc_error[] = "Fullname must be more than 5 letters"; }
        if (strlen($newc_username) > 5)   { $nc_error[] = "Username must be more than 3 letters"; }
        if (strlen($newc_college) > 3)    { $nc_error[] = "College must be more than 3 letters"; }
        if (strlen($newc_job) > 5)        { $nc_error[] = "Job must be more than 5 letters"; }

        foreach ($newc_errors as $oerror) {
          error_msg($oerror);
        }

        if (empty($newc_errors)) {
          $update_controller = $conn->prepare("UPDATE controller SET
            ControllerName = ?,
            Controller_Username = ?,
            Controller_FB = ?,
            Controller_Email = ?,
            Controller_YouTube = ?,
            Controller_GoogleP = ?,
            Controller_Instagram = ?,
            Controller_Twitter = ?,
            College = ?,
            Job = ? WHERE ControllerID = ?");
          $update_controller->execute(array($newc_fullname, $newc_username, $newc_password, $newc_fb_acc,
          $newc_email, $newc_youchan, $newc_google_p, $newc_insta, $newc_twitter, $newc_college, $newc_job, $cud['ControllerID']));
          if ($update_controller->rowCount() > 0) {
            success_msg('Controller Has Been Updated!');
            header('REFRESH: 3;URL=?control=manage');
          } else {
            error_msg("There's Something Went Wrong! Can't Update Controller");
          }
        }
      }
    ?>
    <?php  ?>
    <section class='controller-edit'>
      <h1 class='rsss'></h1>
      <h1 class='center mb-15 mt-15 _100 light'>Edit Controller</h1>
      <form method="post">
        <span>Fullname:</span>
        <input type='text' value='<?php echo $cud['ControllerName'];?>' placeholder='Fullname' name='newc_fullname'>
        <span>Username:</span>
        <input type='text' value='<?php echo $cud['Controller_Username'];?>' placeholder='Username' name='newc_username'>
        <span>Email:</span>
        <input type='text' value='<?php echo $cud['Controller_Email'];?>' placeholder='Email' name='newc_email'>
        <span>College:</span>
        <input type='text' value='<?php echo $cud['College'];?>' placeholder='College' name='newc_college'>
        <span>Job title:</span>
        <input type='text' value='<?php echo $cud['Job'];?>' placeholder='Job title' name='newc_job'>
        <span>Social Media Account</span>
        <input value="<?php echo $cud['Controller_FB'] ?>" placeholder='Facebook' name='newc_fb_acc'>
        <input value="<?php echo $cud['Controller_Twitter'] ?>" placeholder='Twitter' name='newc_twitter'>
        <input value="<?php echo $cud['Controller_GoogleP'] ?>" placeholder='Google+' name='newc_google_p'>
        <input value="<?php echo $cud['Controller_Instagram'] ?>" placeholder='Instagram' name='newc_insta'>
        <input value="<?php echo $cud['Controller_YouTube'] ?>" placeholder="YouTube" name='newc_youchan'>
        <button class='btn btn-dark'>Done editing</button>
      </form>
    </section>
  <?php } ?>

  <!-- New User Page -->
  <?php if ($_GET['control'] == 'new-controller') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $need_replace = array("'", '"', "&", "^", '%', "-", "+", "*", "!", "@", "#", "$", ">", "<", ",", "?", ":", ";", "`", "(", ")", ".");

      $nc_fullname     = str_replace($need_replace, "", $_POST['nc_fullname']);
      $nc_username     = str_replace($need_replace, "", $_POST['nc_username']);
      $nc_password     = str_replace($need_replace, "", $_POST['nc_password']);
      $nc_email        = str_replace($need_replace, "", $_POST['nc_email']);
      $nc_youchan      = str_replace($need_replace, "", $_POST['nc_youchan']);
      $nc_fb_acc       = str_replace($need_replace, "", $_POST['nc_fb_acc']);
      $nc_google_p     = str_replace($need_replace, "", $_POST['nc_google_p']);
      $nc_twitter      = str_replace($need_replace, "", $_POST['nc_twitter']);
      $nc_insta        = str_replace($need_replace, "", $_POST['nc_insta']);
      $nc_college      = str_replace($need_replace, "", $_POST['nc_college']);
      $nc_job          = str_replace($need_replace, "", $_POST['nc_job']);
      $nc_errors = array();


      if (empty($nc_fullname))    { $nc_errors[] = "Fullname can't Be Empty"; }
      if (empty($nc_username))    { $nc_errors[] = "Username can't Be Empty"; }
      if (empty($nc_password))    { $nc_errors[] = "Password can't Be Empty"; }
      if (empty($nc_email))       { $nc_errors[] = "Email can't Be Empty"; }
      if (empty($nc_youchan))     { $nc_errors[] = "Your YouTube Channel can't Be Empty"; }
      if (empty($nc_fb_acc))      { $nc_errors[] = "FB Account can't Be Empty"; }
      if (empty($nc_google_p))    { $nc_errors[] = "Google+ Account can't Be Empty"; }
      if (empty($nc_twitter))     { $nc_errors[] = "Twitter Account can't Be Empty"; }
      if (empty($nc_insta))       { $nc_errors[] = "Instagram Account can't Be Empty"; }
      if (empty($nc_college))     { $nc_errors[] = "College can't Be Empty"; }
      if (empty($nc_job))         { $nc_errors[] = "Job Title can't Be Empty"; }

      if (strlen($nc_fullname) > 5)   { $nc_error[] = "Fullname must be more than 5 letters"; }
      if (strlen($nc_username) > 5)   { $nc_error[] = "Username must be more than 3 letters"; }
      if (strlen($nc_password) > 5)   { $nc_error[] = "Password must be more than 5 letters Contains Letters and Numbers"; }
      if (strlen($nc_college) > 3)    { $nc_error[] = "College must be more than 3 letters"; }
      if (strlen($nc_job) > 5)        { $nc_error[] = "Job must be more than 5 letters"; }

      foreach ($nc_errors as $error) {
        error_msg($error);
      }

      if (empty($error)) {
        $new_controller = $conn->prepare("INSERT INTO
          controller(ControllerName, Controller_Username, Controller_Password, Controller_FB, Controller_Email,
          Controller_YouTube, Controller_GoogleP, Controller_Instagram, Controller_Twitter, College, Job)
          VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $new_controller->execute(array($nc_fullname, $nc_username, $nc_password, $nc_fb_acc,
        $nc_email, $nc_youchan, $nc_google_p, $nc_insta, $nc_twitter, $nc_college, $nc_job));
        if ($new_controller->rowCount() > 0) {
          success_msg('Controller Has Been Created!');
          header('REFRESH: 3;URL=?control=manage');
        } else {
          error_msg("There's Something Went Wrong! Controller not inserted");
        }
      }

    }
  ?>
    <section class="new-controller">
      <h1>New Controller</h1>
      <form method='post'>
        <input type='text' placeholder="Enter Fullname" name='nc_fullname'>
        <input type='text' placeholder="Enter Username" name='nc_username'>
        <input type='password' placeholder="Enter Password" name='nc_password'>
        <input type='email' placeholder="Enter Email" name='nc_email'>
        <input type='url' placeholder="Enter Youtube channel" name='nc_youchan'>
        <input type='url' placeholder="Enter Facebook Account" name='nc_fb_acc'>
        <input type='url' placeholder="Enter Google+ Account" name='nc_google_p'>
        <input type='url' placeholder="Enter Twitter Account" name='nc_twitter'>
        <input type='url' placeholder="Enter Insatgram Account" name='nc_insta'>
        <input type='text' placeholder="Enter College" name='nc_college'>
        <input type='text' placeholder="Enter Job" name='nc_job'>
        <button class='btn btn-dark'>Create</button>
      </form>
    </section><br><br>
  <?php } ?>

<?php include($paths['AIF'] . 'footer.php'); ?>
