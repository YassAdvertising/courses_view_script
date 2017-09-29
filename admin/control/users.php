<?php
  session_start();
  $page_title = 'Dashboard';
  include('incs/all.php');
  redirectGET('control', '?control=manage');
  $getUsers = $conn->prepare("SELECT * FROM users");
  $getUsers->execute();
  $getUserData = $getUsers->fetchAll();
?>

  <!-- Controllers Page -->

  <!-- Manage Page -->
  <?php if ($_GET['control'] == 'manage') { ?>
    <section class='users-manage'>
      <h1 class='center _100 light mt-15 mb-15 gray'>All Users</h1>
      <?php if (count($getUserData) == 0) { error_msg('There\'s any users yet! <a href="?control=new-user">New User</a>'); exit; } ?>
      <table>
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Fullname</th>
          <th>Email</th>
          <th>College</th>
          <th>Job Title</th>
          <th>Settings</th>
        </tr>
        <?php foreach ($getUserData as $userData) { ?>
          <tr>
            <td><?php echo $userData['UserID']; ?></td>
            <td><?php echo $userData['Username']; ?></td>
            <td><?php echo $userData['Fullname']; ?></td>
            <td><?php echo $userData['Email']; ?></td>
            <td><?php echo $userData['College']; ?></td>
            <td><?php echo $userData['Job']; ?></td>
            <td>
              <a href="?control=delete&user_id=<?php echo $userData['UserID']; ?>" class='btn btn-danger tooltip' text='Delete'><i class='fa fa-trash'></i></a>
              <a href="?control=edit&user_id=<?php echo $userData['UserID']; ?>" class='btn btn-primary tooltip' text='Edit'><i class='fa fa-edit'></i></a>
              <a href="?control=no-control&action=view&user_id=<?php echo $userData['UserID']; ?>" class='btn btn-warning tooltip' text='View'><i class='fa fa-eye'></i></a>
            </td>
          </tr>
        <?php } ?>
      </table>
      <a href="?control=new-user" class='mt-15 ml-25' style='display: block;'><i class='fa fa-user-plus'></i> New user ?</a>
    </section>
  <?php } ?>

  <!-- Delete Page -->
  <?php if ($_GET['control'] == 'delete') { ?>
    <?php
      run_css('body { background-color: #F1F1F1; }');
      redirect_get_error('user_id', 'There\'s no User Selected to delete !');
      $controller_data = select('users', 'UserID', $_GET['user_id']);
    ?>
    <div class="user-delete">
      <div class="result"></div>
      <input type='hidden' value='<?php echo $_GET['user_id']; ?>' class='user-id'>
      <div class='confirm alert'>
        <span>Are you sure to delete this user ?</span>
        <button class="material-button blue">Yes</button>
        <button class="material-button red" onclick='window.location.href = "?control=manage"'>Cancel</button>
      </div>
    </div>
  <?php } ?>

  <!-- View User Information -->
  <?php if (@$_GET['action'] == 'view') { ?>
    <?php
      run_css('body { background-color: #F1F1F1; }');
      redirect_get_error('user_id', 'There\'s no user Selected to view his information !');
      $userD = select('users', 'UserID', $_GET['user_id']);
      $dateUser = explode(' ', $userD['JoinedIn']);
    ?>
    <section class="user-view">
      <header>
        <?php
          $next_user = ++$_GET['user_id'];
          $prev_user = $_GET['user_id'] - 2;
          $select_user_next = $conn->prepare("SELECT UserID FROM users WHERE UserID = ?");
          $select_user_next->execute(array($next_user));
          $rowCountNext = $select_user_next->rowCount();
          $select_user_prev = $conn->prepare("SELECT UserID FROM users WHERE UserID = ?");
          $select_user_prev->execute(array($prev_user));
          $rowCountPrev = $select_user_prev->rowCount();
        ?>
        <?php if ($rowCountPrev > 0) { ?>
          <i class="material-icons" onclick=location.href="?control=no-control&action=view&user_id=<?php echo $prev_user; ?>">arrow_back</i>
        <?php } ?>
        <?php if ($rowCountNext > 0) { ?>
          <i class="material-icons right" onclick=location.href="?control=no-control&action=view&user_id=<?php echo $next_user; ?>">arrow_forward</i>
        <?php } ?>
      </header>
      <section class="content">
        <h1 class='_100'><?php echo $userD['Fullname']; ?> - <span>@<?php echo $userD['Username']; ?></span></h1>
        <h2><i class='fa fa-clock-o'></i> <?php echo $dateUser[0]; ?></h2>
        <h3 class='gray _100 mt-5'><i class='fa fa-envelope'></i> <?php echo $userD['Email']; ?></h3>
        <h4><i class='fa fa-address-card'></i> <strong>College:</strong> <?php echo $userD['College']; ?></h4>
        <h4><i class='fa fa-newspaper-o'></i> <strong>Job:</strong> <?php echo $userD['Job']; ?></h4>
      </section>
    </section>
  <?php } ?>

  <!-- Controllers Edit Page -->
  <?php if ($_GET['control'] == 'edit') { ?>
    <?php
      $userdata = select('users', 'UserID', $_GET['user_id']);
    ?>
    <?php
      if (!isset($_GET['user_id'])) {
        error_msg("Please choose course to edit");
        header('REFRESH: 5;URL=?control=manage');
        exit();
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fullname     = strip_tags(addslashes($_POST['fullname']));
        $username     = strip_tags(addslashes($_POST['username']));
        $email        = strip_tags(addslashes($_POST['email']));
        $college      = strip_tags(addslashes($_POST['college']));
        $job          = strip_tags(addslashes($_POST['job']));

        $errors = array();

        if (empty($fullname))  { $errors[] = "Course Name Can't Be Empty"; }
        if (empty($username))  { $errors[] = "Course Link Can't Be Empty"; }
        if (empty($email))     { $errors[] = "Course Lessons Can't Be Empty"; }
        if (empty($college))   { $errors[] = "Course Lang Can't Be Empty"; }
        if (empty($job))       { $errors[] = "Course Descrption Can't Be Empty"; }

        if (strlen($fullname) <= 5 && !empty($fullname)) { $errors[] = "Fullname must be more than 5 letters"; }
        if (strlen($username) <= 3 && !empty($username)) { $errors[] = "Username must be more than 3 letters"; }
        if (strlen($college) < 3 && !empty($college))    { $errors[] = "College must be more than 3 letters"; }
        if (strlen($job) < 3 && !empty($job))            { $errors[] = "Job must be more than 3 letters"; }

        foreach ($errors as $error) {
          echo "<div class='alert error'>$error</div>";
        }

        if (empty($error)) {
          $edit_user = $conn->prepare("UPDATE users Set Username = ?, Fullname = ?, Email = ?, College = ?, Job = ? Where UserID = ?");
          $edit_user->execute(array($username, $fullname, $email, $college, $job, $_GET['user_id']));
          if ($edit_user->rowCount() > 0) {
            success_msg("User information has been updated");
            header('REFRESH: 5;URL=?control=manage');
          }
        }

      }
      $__get__id = $_GET['user_id'];
      $getIDCourse = select('users', 'UserID', $__get__id);
    ?>
    <section class='user-edit'>
      <h1 class='center mb-15 mt-15 _100 light'>Edit User</h1>
      <form method="post">
        <span>Fullname:</span>
        <input type='text' value='<?php echo $userdata['Fullname'];?>' name='fullname'>
        <span>Username:</span>
        <input type='text' value='<?php echo $userdata['Username'];?>' name='username'>
        <span>Email:</span>
        <input type='text' value='<?php echo $userdata['Email'];?>' name='email'>
        <span>College:</span>
        <input type='text' value='<?php echo $userdata['College'];?>' name='college'>
        <span>Job title:</span>
        <input type='text' value='<?php echo $userdata['Job'];?>' name='job'>
        <button class='btn btn-dark'>Done editing</button>
      </form>
    </section>
  <?php } ?>

  <!-- New User Page -->
  <?php if ($_GET['control'] == 'new-user') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $need_replace = array("'", '"', "&", "^", '%', "-", "+", "*", "!", "@", "#", "$", ">", "<", ",", "?", ":", ";", "`", "(", ")", ".");

      $nnfullname             = str_replace($need_replace, "", $_POST['ufullname']);
      $nnusername             = str_replace($need_replace, "", $_POST['uusername']);
      $nnpassword             = $_POST['upassword'];
      $nnemail                = $_POST['uemail'];
      $nncollege              = str_replace($need_replace, "", $_POST['ucollege']);
      $nnjobtitle             = str_replace($need_replace, "", $_POST['ujob']);

      $errors = array();

      if (empty($nnfullname))         { $errors[] = "Please fill your Fullname"; }
      if (empty($nnusername))         { $errors[] = "Please fill your Username"; }
      if (empty($nnpassword))         { $errors[] = "Please fill your Password"; }
      if (empty($nnemail))            { $errors[] = "Please fill your Email"; }
      if (empty($nncollege))          { $errors[] = "Please enter your College"; }
      if (empty($nnjobtitle))         { $errors[] = "Please enter your Facebook account"; }

      if (strlen($nnfullname) <= 6)  { $errors[] = "Fullname must be more than 6 letters"; }
      if (strlen($nnpassword) <= 8)  { $errors[] = "Password must be more than 8 letters, Contains Letters and numbers"; }
      if (strlen($nnusername) <= 4)  { $errors[] = "Username must be more than 4 letters"; }
      if (strlen($nncollege) <= 4)   { $errors[] = "College must be more than 4 letters"; }
      if (strlen($nnjobtitle) <= 4)  { $errors[] = "Job Title must be more than 4 letters"; }

      foreach ($errors as $error) { echo "<div class='alert error'>$error</div>"; }

      if (empty($errors)) {

        $new_user = $conn->prepare("INSERT INTO users(Username, Fullname, College, Email, Password, Job)
        VALUES(?, ?, ?, ?, ?, ?)");
        $new_user->execute(array($nnusername, $nnfullname, $nncollege, $nnemail, $nnpassword, $nnjobtitle));
        if ($new_user->rowCount() > 0) {
          echo "Insered Times: <<< " . $new_user->rowCount() . ' >>>';
        }
      }
    }
  ?>
    <section class="new-user">
      <div class="daata"></div>
      <h1>New User</h1>
      <form method="post">
        <input type='text' placeholder="Enter Fullname" name='ufullname'>
        <input type='textstring' placeholder="Enter Username" name='uusername'>
        <input type='password' placeholder="Enter Password" name='upassword'>
        <input type='email' placeholder="Enter Email" name='uemail'>
        <input type='text' placeholder="Enter College" name='ucollege'>
        <input type='text' placeholder="Enter Job Title" name='ujob'>
        <button class='btn btn-dark'>Create user</button>
      </form>
    </section><br><br>
  <?php } ?>

<?php include($paths['AIF'] . 'footer.php'); ?>
