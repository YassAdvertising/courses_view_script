<?php
  session_start();
  $page_title = 'Dashboard';
  include('incs/all.php');
  $users_count           = count_recs('users');
  $controller_count      = count_recs('controller');
  $messages_count        = count_recs('messages');
  $courses_count         = count_recs('courses');
?>

  <!-- Dashboard - Page -->

  <!-- Start Dashboard Main Container -->
  <article class="dashboard">
    <h1 class='gray _100'>Dashboard</h1>
    <section class="stats">
      <div onclick='location.href="users.php"'>
        <h1><i class='fa fa-users'></i> Users</h1>
        <h3><?php echo $users_count; ?></h3>
      </div>
      <div onclick='location.href="courses.php"'>
        <h1><i class='fa fa-list'></i> Courses</h1>
        <h3><?php echo $courses_count; ?></h3>
      </div>
      <div onclick='location.href="messages.php"'>
        <h1><i class='fa fa-send'></i> Messages</h1>
        <h3><?php echo $messages_count; ?></h3>
      </div>
      <div onclick='location.href="controllers.php"'>
        <h1><i class='fa fa-gamepad'></i> Admins</h1>
        <h3><?php echo $controller_count; ?></h3>
      </div>
    </section><hr>

  </article>

<?php include($paths['AIF'] . 'footer.php'); ?>
