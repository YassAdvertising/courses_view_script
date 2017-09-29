<?php

  class Validate {

    public $errors = [];

    public $success_msg;

    public function is_empty($target, $msg)
    {
      if (empty($target)) {
        $this->errors[] = $msg;
      }
    }

    public function max_length($target, $max_length, $msg)
    {
      if (strlen($target) >= $max_length) {
        $this->errors[] = $msg;
      }
    }

    public function min_length($target, $min_length, $msg)
    {
      if (strlen($target) <= $min_length && !empty($target)) {
        $this->errors[] = $msg;
      }
    }

    public function show_errors()
    {
      foreach ($this->errors as $error) {
        error_msg($error);
      }
    }

  }
