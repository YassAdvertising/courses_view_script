<?php
  session_start();
  $page_title = 'Messages';
  include('incs/all.php');

  $msgs = $conn->prepare("SELECT * FROM messages");
  $msgs->execute();
  $msgsData = $msgs->fetchAll();

  redirectGET('action', '?action=main');
?>

  <!-- All Messages That Sent For Controller -->
  <?php if ($_GET['action'] == 'main') { ?>
    <div class="messages-controller">
      <h1 class='_100 center light'>Message Requests.</h1>
      <?php if (count($msgsData) == 0) { error_msg("There's no any <strong>messages</strong> were sent! "); exit(); } ?>
      <table>
        <tr>
          <th>#</th>
          <th>Message From</th>
          <th>Message User Phone</th>
          <th>Settings</th>
        </tr>
        <?php foreach ($msgsData as $msgDa) { ?>
          <tr>
            <td><?php echo $msgDa['MessageID']; ?></td>
            <td><?php echo $msgDa['MessageUsername']; ?></td>
            <td><?php echo $msgDa['MessagePhone']; ?></td>
            <td>
              <a href="?action=delete&msg_id=<?php echo $msgDa['MessageID']; ?>" class='btn btn-danger tooltip' text='Delete'><i class='fa fa-trash'></i></a>
              <a href="?action=view&msg_id=<?php echo $msgDa['MessageID']; ?>" class='btn btn-warning tooltip' text='View'><i class='fa fa-eye'></i></a>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
  <?php } ?>

  <!-- Delete Message Action -->
  <?php if ($_GET['action'] == 'delete') {
    run_css('body { background-color: #f1f1f1; }');
    redirectGET('msg_id', '?action=main');
    if (isset($_POST['ok'])) {
      $msg_id = $_POST['msg_id'];
      $delete_msg = $conn->prepare("DELETE FROM messages WHERE MessageID = ?");
      $delete_msg->execute(array($msg_id));
      header('Location: messages.php?action=main');
      exit;
    }
  ?>
    <div class="message-delete">
      <div class='confirm alert'>
        <span>Are you sure to delete this message ?</span>
        <form method="post">
          <input type='hidden' value='<?php echo $_GET['msg_id']; ?>' class='con-id' name='msg_id'>
          <button class="material-button blue" name='ok'>Yes</button>
          <button class="material-button red" onclick='window.location.href = "?control=manage"'>Cancel</button>
        </form>
      </div>
    </div>
  <?php } ?>

  <!-- View Message -->
  <?php if ($_GET['action'] == 'view') {
    run_css('body { background-color: #f1f1f1; }');
    redirectGET('msg_id', '?action=main');
    $message_selected_data = select('messages', 'MessageID', $_GET['msg_id']);
    $select_msg_withErr = $conn->prepare("SELECT * FROM messages WHERE MessageID = ?");
    $select_msg_withErr->execute(array($_GET['msg_id']));
    if ($select_msg_withErr->rowCount() == 0) {
      echo "<div class='alert error'>There's No <strong>Message</strong> with this <strong>ID</strong> In <strong>URL</strong> </div>";
      exit;
    }
  ?>
    <h1 class='viewmsgtext'>View Message From: <span><?php echo $message_selected_data['MessageUsername']; ?></span></h1>
    <article class="message-view">
      <section class="header">
        <h2><i class='fa fa-user'></i> <?php echo "From: " . $message_selected_data['MessageUsername']; ?></h2>
        <span><i class='fa fa-phone'></i> <?php echo "Phone: " . $message_selected_data['MessagePhone']; ?></span>
      </section>
      <section class="content">
        <h3 class='_100'><?php echo "<strong>" . $message_selected_data['MessageUsername'] . '</strong> Said:'; ?></h3>
        <p class='light'><?php echo $message_selected_data['MessageContent']; ?></p>
      </section>
    </article>

  <?php } ?>
<?php include($paths['AIF'] . 'footer.php'); ?>
