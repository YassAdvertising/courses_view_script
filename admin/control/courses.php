<?php
  session_start();
  $page_title = 'Courses';
  include('incs/all.php');
  redirectGET('control', '?control=manage');
  $courses = $conn->prepare("SELECT * FROM courses");
  $courses->execute();
  $courses_data = $courses->fetchAll();
?>

  <!-- Controllers Page -->

  <!-- Manage Page -->
  <?php if ($_GET['control'] == 'manage') { ?>
    <section class='courses-manage'>
      <h1 class='center _100 light mt-15 mb-15 gray'>All Courses</h1>
      <?php if (count($courses_data) == 0) { error_msg('There\'s no courses yet <a href="?control=new-course">New Course</a>'); exit; } ?>
      <table>
        <tr>
          <th>#</th>
          <th>Course Name</th>
          <th>Course Add Date</th>
          <th>Lessons</th>
          <th>Langauage</th>
          <th>Settings</th>
        </tr>
        <?php foreach ($courses_data as $couData) { ?>
          <tr>
            <td><?php echo $couData['CourseID']; ?></td>
            <td><?php echo $couData['CourseName']; ?></td>
            <td><?php echo $couData['CourseDate']; ?></td>
            <td><?php echo $couData['Lessons']; ?></td>
            <td><?php echo $couData['Lang']; ?></td>
            <td>
              <a href="?control=delete&course_id=<?php echo $couData['CourseID']; ?>" class='btn btn-danger tooltip' text='Delete'><i class='fa fa-trash'></i></a>
              <a href="?control=edit&course_id=<?php echo $couData['CourseID']; ?>" class='btn btn-primary tooltip' text='Edit'><i class='fa fa-edit'></i></a>
              <a href="?control=no-control&action=view&course_id=<?php echo $couData['CourseID'] ?>" class='btn btn-warning tooltip' text='View'><i class='fa fa-eye'></i></a>
            </td>
          </tr>
        <?php } ?>
      </table>
      <a href="?control=new-course" class='mt-15 ml-25' style='display: block;'><i class='fa fa-plus'></i> New Course</a>
    </section>
  <?php } ?>

  <!-- Delete Page -->
  <?php if ($_GET['control'] == 'delete') { ?>
    <?php
      run_css('body { background-color: #F1F1F1; }');
      redirect_get_error('course_id', 'There\'s no Controller Selected to delete !');
      $course_data = select('courses', 'CourseID', $_GET['course_id']);
    ?>
    <div class="delete-course">
      <div class="result"></div>
      <input type='hidden' value='<?php echo $_GET['course_id']; ?>' class='cou-id'>
      <div class='confirm alert'>
        <span>Are you sure to delete this course ?</span>
        <button class="material-button blue">Yes</button>
        <button class="material-button red" onclick='window.location.href = "?control=manage"'>Cancel</button>
      </div>
    </div>
  <?php } ?>

  <!-- View Course Information -->
  <?php if ($_GET['control'] == 'no-control' && $_GET['action'] == 'view') { ?>
    <?php
      run_css('body { background-color: #F1F1F1; }');
      redirect_get_error('course_id', 'There\'s no Courses Selected to view information !');
      $courseD = select('courses', 'CourseID', $_GET['course_id']);
      $dateCourse = explode(' ', $courseD['CourseDate']);
    ?>
    <section class="courses-view">
      <header>
        <?php
          $next_cou = ++$_GET['course_id'];
          $prev_cou = $_GET['course_id'] - 2;
          $select_cou_next = $conn->prepare("SELECT CourseID FROM courses WHERE CourseID = ?");
          $select_cou_next->execute(array($next_cou));
          $rowCountNext = $select_cou_next->rowCount();
          $select_cou_prev = $conn->prepare("SELECT CourseID FROM courses WHERE CourseID = ?");
          $select_cou_prev->execute(array($prev_cou));
          $rowCountPrev = $select_cou_prev->rowCount();
        ?>
        <?php
          if ($rowCountPrev == 0 && $rowCountNext == 0) {
            echo "<h4 style='text-align: center; color: #FFF; margin-top: 15px;'>No next or previous</h4>";
          }
        ?>
        <?php if ($rowCountPrev > 0) { ?>
          <i class="material-icons" onclick=location.href="?control=no-control&action=view&course_id=<?php echo $prev_cou; ?>">arrow_back</i>
        <?php } ?>
        <?php if ($rowCountNext > 0) { ?>
          <i class="material-icons right" onclick=location.href="?control=no-control&action=view&course_id=<?php echo $next_cou; ?>">arrow_forward</i>
        <?php } ?>
      </header>
      <section class="content">
        <h1 class='_100'><?php echo $courseD['CourseName']; ?></h1>
        <h2><i class='fa fa-clock-o'></i> <?php echo $dateCourse[0]; ?></h2>
        <h3 class='gray _100 mt-5'><i class='fa fa-globe'></i> <?php echo $courseD['Lang']; ?></h3>
        <h3 class='gray _100 mt-5'><i class='fa fa-play'></i> <?php echo $courseD['Lessons']; ?></h3>
      </section>
    </section>
  <?php } ?>

  <!-- Edit Page -->
  <?php if ($_GET['control'] == 'edit') {
    if (!isset($_GET['course_id'])) {
      error_msg("Please choose course to edit");
      header('REFRESH: 5;URL=?control=manage');
      exit();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $new_cn = $_POST['new_cn'];
      $new_cl = $_POST['new_cl'];
      $new_ds = $_POST['new_ds'];
      $new_ls = $_POST['new_ls'];
      $new_lg = $_POST['new_lg'];

      $errors = array();
      if (empty($new_cn)) { $errors[] = "Course Name Can't Be Empty"; }
      if (empty($new_cl)) { $errors[] = "Course Link Can't Be Empty"; }
      if (empty($new_ds)) { $errors[] = "Course Lessons Can't Be Empty"; }
      if (empty($new_ls)) { $errors[] = "Course Lang Can't Be Empty"; }
      if (empty($new_lg)) { $errors[] = "Course Descrption Can't Be Empty"; }

      if (strlen($new_cn) <= 3 && !empty($course_name)) { $errors[] = "Course name must be more than 3 letters"; }
      if (strlen($new_ls) <= 2 && !empty($course_less)) { $errors[] = "Course Language must be more than 3 letters"; }
      if (strlen($new_ds) <= 35 && !empty($course_desc)) { $errors[] = "Write a long descrption about course"; }

      foreach ($errors as $error) {
        echo "<div class='alert error'>$error</div>";
      }

      if (empty($error)) {
        $edit_course = $conn->prepare("UPDATE courses Set CourseName = ?, CourseLink = ?, Lang = ?, Lessons = ?, CourseDesc = ? Where CourseID = ?");
        $edit_course->execute(array($new_cn, $new_cl, $new_lg, $new_ls, $new_ds, $_GET['course_id']));
        if ($edit_course->rowCount() > 0) {
          success_msg("Course has been updated");
          header('REFRESH: 5;URL=?control=manage');
        }
      }

    }
    $__get__id = $_GET['course_id'];
    $getIDCourse = select('courses', 'CourseID', $__get__id);
  ?>
    <div class="courses-edit">
      <h1>Edit Course</h1>
      <form method="post">
        <input type='text' placeholder="Enter New Course Name" name='new_cn' value="<?php echo $getIDCourse['CourseName']; ?>">
        <input type='text' placeholder="Enter New Link" name='new_cl' value="<?php echo $getIDCourse['CourseLink']; ?>">
        <textarea placeholder="Enter New Descrption" name='new_ds'><?php echo $getIDCourse['CourseDesc']; ?></textarea>
        <input type='text' placeholder="Enter New Number Of Lessons" name='new_ls' value="<?php echo $getIDCourse['Lessons']; ?>">
        <input type='text' placeholder="Enter New Langauge" name='new_lg' value="<?php echo $getIDCourse['Lang']; ?>">
        <button class='btn btn-dark'>Done editing</button>
      </form>
    </div>
  <?php } ?>

  <!-- New User Page -->
  <?php if ($_GET['control'] == 'new-course') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $course_name = strip_tags($_POST['coursename']);
      $course_link = strip_tags($_POST['courselink']);
      $course_less = strip_tags($_POST['less']);
      $course_lang = strip_tags($_POST['lang']);
      $course_desc = strip_tags($_POST['course_desc']);

      $errors = array();
      if (empty($course_name)) { $errors[] = "Course Name Can't Be Empty"; }
      if (empty($course_link)) { $errors[] = "Course Link Can't Be Empty"; }
      if (empty($course_less)) { $errors[] = "Course Lessons Can't Be Empty"; }
      if (empty($course_lang)) { $errors[] = "Course Lang Can't Be Empty"; }
      if (empty($course_desc)) { $errors[] = "Course Descrption Can't Be Empty"; }

      if (strlen($course_name) <= 3 && !empty($course_name)) { $errors[] = "Course name must be more than 3 letters"; }
      if (strlen($course_lang) <= 2 && !empty($course_less)) { $errors[] = "Course Language must be more than 3 letters"; }
      if (strlen($course_desc) <= 35 && !empty($course_desc)) { $errors[] = "Write a long descrption about course"; }

      foreach ($errors as $error) {
        echo "<div class='alert error'>$error</div>";
      }
      if (empty($error)) {
        $new_course = $conn->prepare("INSERT INTO courses(CourseName, CourseLink, Lang, Lessons, CourseDesc)
        VALUES(?, ?, ?, ?, ?)");
        $new_course->execute(array($course_name, $course_link, $course_lang, $course_less, $course_desc));
        if ($new_course->rowCount() > 0) {
          success_msg("Course has been inserted");
          header('REFRESH: 5;URL=?control=manage');
        }
      }
    }
  ?>
    <section class="new-course">
      <div class="results"></div>
      <h1>New Course</h1>
      <form method='post'>
        <input type='text' placeholder="Enter Course Name" name='coursename'>
        <input type='text' placeholder="Enter Link" name='courselink'>
        <textarea placeholder="Enter Descrption" name='course_desc'></textarea>
        <input type='text' placeholder="Enter Number Of Lessons" name='less'>
        <input type='text' placeholder="Enter Langauge" name='lang'>
        <button class='btn btn-dark'>Add Course</button>
      </form>
    </section><br><br>
  <?php } ?>

<?php include($paths['AIF'] . 'footer.php'); ?>
