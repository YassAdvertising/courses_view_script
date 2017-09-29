<?php
  session_start();
  $page_title         = 'Contact';
  // $meta_desc          = 'Courses Of Msh 3arf';
  // $meta_keywords      = 'Msh 3arf';
  include('incs/all.php');

  run_css('.navbar-main { background-color: #111 !important; }');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $msg   = $_POST['msg'];
    $new_message = new Message();
    $new_message->new_message($name, $msg, $phone);
    if ($new_message->sent == true) {
      success_msg("Your Message Has Been Sent!");
      $new_message->redirect_after_msg();
    } else {
      error_msg("There's Something Went Wrong!");
    }
  }

?>

  <!-- Start Contact Form -->
    <h1 class='_100 center gray mb-15 light'><i class='fa fa-phone-square'></i> Need to contact with courses maker ? Send message!</h1>
    <div class="contact-form">
      <form method="post">
        <input type='text' name='name' placeholder="Enter your name" required minlength='5' maxlength="50">
        <input type='email' name='email' placeholder="Enter your email address" required min-length='5' maxlength="255">
        <input type='phone' name='phone' placeholder="Enter your phone" required minlength='5' maxlength="25">
        <textarea name="msg" placeholder="Enter your message" required minlength='5' maxlength="6000"></textarea>
        <button class='btn btn-black'><i class='fa fa-send'></i> Send Message</button>
      </form>
    </div>
  <!-- End Contact Form -->

<?php include($paths['all_important_files'] . 'footer.php'); ?>
