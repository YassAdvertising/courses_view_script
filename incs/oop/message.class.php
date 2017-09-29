<?php

  require_once('incs/all/connection.php');

  Class Message {

    public $sent;

    public function new_message($message_username, $message_content, $message_user_phone)
    {
      global $conn;
      $new_msg = $conn->prepare("INSERT INTO messages(MessageUsername, MessageContent, MessagePhone) VALUES(?, ?, ?)");
      $new_msg->execute(array($message_username, $message_content, $message_user_phone));
      if ($new_msg->rowCount() > 0) {
        $this->sent = true;
      } else {
        $this->sent = false;
      }
    }

    public function redirect_after_msg()
    {
      redirect_js('index.php', 2000);
    }

  }
