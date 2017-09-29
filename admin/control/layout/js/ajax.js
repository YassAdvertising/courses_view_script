$(function () {

  // Delete Controller Action //
  $('.controllers-delete .confirm button:eq(0)').on('click', function () {
    var controller_id = $('.controllers-delete .con-id').val();
    $.ajax({
      url: 'ajax/controllers.delete.ajax.php',
      type: 'post',
      data: 'accept-delete=1&controller_id=' + controller_id,
      success: function(res) {
        $('.controllers-delete .result').html(res);
      }
    });
  });

  // Delete User Action //
  $('.user-delete .confirm button:eq(0)').on('click', function () {
    var controller_id = $('.user-delete .user-id').val();
    $.ajax({
      url: 'ajax/user-delete.ajax.php',
      type: 'post',
      data: 'accept-delete=1&user_id=' + controller_id,
      success: function(res) {
        $('.user-delete .result').html(res);
      }
    });
  });

  // Delete Course Action //
  $('.delete-course .confirm button:eq(0)').on('click', function () {
    var course_id = $('.delete-course .cou-id').val();
    $.ajax({
      url: 'ajax/courses-delete.ajax.php',
      type: 'post',
      data: 'accept-delete=1&course_id=' + course_id,
      success: function(res) {
        $('.delete-course .result').html(res);
      }
    });
  });

  // New User Action //
  $('.new-user form button').on('click', function () {
    var ufullname = $('.new-user form input:eq(0)').val();
    var uusername = $('.new-user form input:eq(1)').val();
    var upassword = $('.new-user form input:eq(2)').val();
    var uemail    = $('.new-user form input:eq(3)').val();
    var ucollege  = $('.new-user form input:eq(4)').val();
    var ujobTi    = $('.new-user form input:eq(5)').val();
    $.ajax({
      url: 'ajax/user-new.ajax.php',
      type: 'post',
      data: {
        'ufullname': ufullname,
        'uusername': uusername,
        'upassword': upassword,
        'uemail': uemail,
        'ucollege': ucollege,
        'ujob': ujobTi
      },
      success: function(da) {
        $('.new-user .daata').html(da);
      }
    });
  });

});
