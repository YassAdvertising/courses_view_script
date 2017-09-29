<?php
  session_start();
  $page_title         = 'Courses';
  $meta_desc          = 'Mostafa Ali Cousres';
  $meta_keywords      = 'Mostafa Ali, Courses, New Features';
  include('incs/all.php');
  /* Get Data Of Courses */
  $courses = $conn->prepare("SELECT * FROM courses");
  $courses->execute();
  $courses_data = $courses->fetchAll(); // Returned Data
  run_css('body { background-color: #f3f3f3; } .navbar-main { background-color: #111 !important; }');
?>
  <h1 class='center _100 light gray mb-25'><i class='fa fa-film'></i> Courses</h1>
  <article class="courses-container">
    <?php foreach ($courses_data as $oc) { // $oc mean One Course ?>
      <section class="course">

        <!-- Course Header -->
        <div class='header'><h2><?php echo $oc['CourseName']; ?></h2></div>

        <!-- Course Content And Informations -->
        <div class='course-content'>
          <h2 class='mb-5'><?php echo $oc['CourseName']; ?></h2>
          <span><i class='fa fa-clock-o'></i> <?php echo $oc['CourseDate']; ?></span>
          <p><?php echo $oc['CourseDesc'] ?></p>
          <button class='btn btn-white mt-15' onclick='window.location.href = "view-course.php?course_id=<?php echo $oc['CourseID'] ?>"'><i class='fa fa-eye'></i> View Playlist</button>
        </div>

      </section>
    <?php } ?>
  </article>

<?php include($paths['all_important_files'] . 'footer.php'); ?>
