<?php

  function meta_desc()
  {
    global $meta_desc;
    if (isset($meta_desc)) {
      echo "<meta name='description' content='$meta_desc'>";
    } else { /* Do something, I prefer you don't put any thing */ }
  }
