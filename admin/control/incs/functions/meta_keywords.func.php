<?php

  function meta_keywords()
  {
    global $meta_keywords;
    if (isset($meta_keywords)) {
      echo "<meta name='keywords' content='$meta_keywords'>";
    } else {  }
  }
