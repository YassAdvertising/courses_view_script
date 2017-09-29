
  <?php
    $adminData = getControllerData('admin_id');
    isLogined('admin_id');
  ?>

  <!-- Navigation bar -->
  <nav class="navbar">
    <h1>
      <div><?php echo $adminData['ControllerName'][0]; ?></div>
      <a href="#"><?php echo $adminData['Controller_Username']; ?></a>
    </h1>
    <ul>
      <div class='hidden'>
        <li><a href="index.php">Home</a></li>
        <li><a href="controllers.php">Controllers</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="courses.php">Courses</a></li>
        <li><a href="messages.php">Messages</a></li>
        <li title='Profile'><a href="profile.php"><i class='fa fa-user'></i></a></li>
        <li title='Logout'><a href="logout.php"><i class='fa fa-power-off'></i></a></li>
      </div>
      <li class='open-navbar' style='display: none;'><a href="#"><i class='fa fa-bars'></i></a></li>
    </ul>
    <div class="clearfix"></div>
  </nav>
