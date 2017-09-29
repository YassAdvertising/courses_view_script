$(function () {

  $('.admin-login-form form button').on('click', function () {

    var username = $('.admin-login-form form input:eq(0)').val();
    var password = $('.admin-login-form form input:eq(1)').val();

    $.ajax({
      url: 'login.ajax.php',
      type: 'post',
      data: 'username=' + username + '&password=' + password,
      success: function (output) {
        $('.results').html(output);
      }
    });

  });

});
