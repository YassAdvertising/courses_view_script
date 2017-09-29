<?php
  session_start();
  $page_title = 'Profile';
  include('incs/all.php');
  isLogined('UserID');
  $ud = getUserData('UserID');
  run_css('.navbar-main { background-color: #111 !important; }');
?>

  <!-- Start Profile Page -->

    <!-- Edit Profile Tool To Open The Model -->
    <div class="edit-profile-tool">
      <i class='fa fa-pencil fa-lg'></i>
    </div>

    <!-- Edit Profile Model -->
    <div class="edit-profile-model">
      <div class="header">
        <h1 class='_100 ml-10'><i class='fa fa-pencil'></i> Edit Profile</h1>
        <i class='fa fa-close fa-lg fa-2x'></i>
        <div class='clearfix'></div>
      </div>
      <div class="content">
        <h1 class='center _100 mb-15 mt-15'>Edit Information</h1>
        <div class="profileER"></div>
        <form onsubmit='return false'>
          <span>Username</span>
          <input type='text' value='<?php echo $ud['Username']; ?>'>
          <span>Fullname</span>
          <input type='text' value='<?php echo $ud['Fullname']; ?>'>
          <span>Password</span>
          <input type='password'>
          <span>Email</span>
          <input type='email' value='<?php echo $ud['Email']; ?>'>
          <span>College</span>
          <input type='text' value='<?php echo $ud['College']; ?>'>
          <span>Job Title</span>
          <input type='text' value='<?php echo $ud['Job']; ?>'><br>
          <button class='con-2' id='confirm-edit'>Confirm</button>
          <button class='con'>Cancel</button>
        </form><br><br>
      </div>
    </div>

  <!-- End Profile Page -->

<?php include($paths['all_important_files'] . 'footer.php'); ?>
