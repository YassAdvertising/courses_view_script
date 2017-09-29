
  <!-- Start Navigation Bar -->
    <div class="navbar-main">
      <h1><a href="#">Abdulrahman</a></h1>
      <ul>
        <div class="in-small-devices">
          <li><a href="about-me.php">About me</a></li>
          <li><a href="follow-me.php">Follow me</a></li>
          <li><a href="courses.php">My Courses</a></li>
          <li style='margin-bottom: 15px'><a href="contact.php">Contact</a></li>
          <li class='open-loginmodel' title='Login'><a href="#"><i class='fa fa-sign-in'></i></a></li>
          <li title='New Account'><a href="new-account.php"><i class='fa fa-user-plus'></i></a></li>
        </div>
        <li class='open-nav'><a href="#"><i class='fa fa-bars'></i></a></li>
      </ul>
    </div>
    <br><br><br><br><br>
  <!-- End Navigation Bar -->

  <!-- Body overlay -->
  <div class="body-overlay"></div>

  <!-- Login Form Model -->
    <div class='loginform-model'>
      <div class="header">
        <h2><i class='fa fa-sign-in'></i> Login</h2>
        <span><i class='fa fa-close'></i></span>
        <div class='clearfix'></div>
      </div>
      <div class="content">
        <div class="result"></div>
        <form onsubmit='return false' method="post">
          <input type='text' placeholder="Enter username">
          <input type='password' placeholder="Enter your password">
          <div class='clearfix'></div>
          <button class='btn btn-primary'>Login</button>
        </form>
      </div>
    </div>

    <!-- User Dropdown -->
    <div class="dropdown-user">
      <a href="profile"><i class='fa fa-user fa-fw'></i> Profile</a>
      <a href="profile"><i class='fa fa-edit fa-fw'></i> Edit Account</a>
      <a href="logout"><i class='fa fa-power-off fa-fw'></i> Logout</a>
    </div>
