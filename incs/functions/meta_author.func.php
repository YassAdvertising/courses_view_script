<?php

  function meta_author()
  {
    global $meta_author;
    if (isset($meta_author)) {
      echo "<meta name='author' content='$meta_author'>";
    } else { /* Do something, I prefer you don't put any thing */ }
  }
