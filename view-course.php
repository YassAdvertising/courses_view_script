<?php
  session_start();
  $page_title         = 'View course';
  // $meta_desc          = 'Courses Of Msh 3arf';
  // $meta_keywords      = 'Msh 3arf';
  include('incs/all.php');
  run_css('body { background-color: #f1f1f1; }');
  $get_course_data = $conn->prepare('SELECT * FROM courses WHERE CourseID = ?');
  $course_id = $_GET['course_id'];
  if (!isset($_GET['course_id'])) {
    header('Location: error_pages/404.php');
  }
  $get_course_data->execute(array($course_id));
  $course_data = $get_course_data->fetch();
  run_css('.navbar-main { background-color: #111 !important; }');
  
?>

  <!-- Start Viewing Course Page -->
  <h1 class='_100 gray center mb-25'>Viewing Course</h1>
  <div class="view-course">
    <div class="course">
      <?php echo $course_data['CourseLink']; ?>
    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <hr>
    <!-- Descrption Of The Course -->
    <div class="desc">
      <h1 class='_100 gray mb-15 mt-25 ml-25'>Course Descrption</h1>
      <div class="print-desc">
        <div class="header">
          <h3>Descrption</h3>
        </div>
        <div class="content">
          <h3><i class='fa fa-mortar-board'></i> Lessons: <span><?php echo $course_data['Lessons']; ?></span></h3><hr>
          <h3><i class='fa fa-globe'></i> Language: <span><?php echo $course_data['Lang']; ?></span></h3><hr>
          <h3><i class='fa fa-clock-o'></i> Added Date: <span><?php echo $course_data['CourseDate']; ?></span></h3><hr>
          <h3><i class='fa fa-play-circle'></i> Name: <span><?php echo $course_data['CourseName']; ?></span></h3><hr>
          <h3><i class='fa fa-info-circle'></i> About Course: <span><?php echo $course_data['CourseDesc']; ?></span></h3>
        </div>
      </div>
    </div>
  </div>
  <br><br><br><br><br><br><br><br>
  <!-- End Viewing Course Page -->

<?php include($paths['all_important_files'] . 'footer.php'); ?>
