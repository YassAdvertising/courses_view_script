<?php $page_title = 'Control Panel - Login'; require('incs/all.php'); ?>

  <div class="results"></div>

  <!-- Admin Login Form -->
  <div class="admin-login-form">
    <form onsubmit='return false' autocomplete="off">
      <h1>CP - Login</h1>
      <input type="text" placeholder="Enter username">
      <input type="password" placeholder="Enter password">
      <button class='btn btn-primary'>Login</button>
    </form>
  </div>

<?php include($paths['AIF'] . 'footer.php'); ?>
