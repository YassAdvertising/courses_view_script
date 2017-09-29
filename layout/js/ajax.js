$(function () {

  // Login Action - Ajax
  $('.loginform-model .content form button').on('click', function () {
    var account     = $('.loginform-model .content form input:eq(0)').val(),
        password    = $('.loginform-model .content form input:eq(1)').val();
    $.ajax({
      url: 'ajax/login.ajax.php',
      type: 'post',
      data: 'account=' + account + '&password=' + password,
      success: function(res) {
        $('.loginform-model .content .result').html(res);
      }
    });
  });

  // Register Action - Ajax
  $('.new-account form button').on('click', function () {
    var username = $('.new-account form input:eq(0)').val(),
        fullname = $('.new-account form input:eq(1)').val(),
        password = $('.new-account form input:eq(2)').val(),
        email    = $('.new-account form input:eq(3)').val(),
        college  = $('.new-account form input:eq(4)').val(),
        jobTitle = $('.new-account form input:eq(5)').val();
    $.ajax({
      url: 'ajax/register.ajax.php',
      type: 'post',
      data: {
        'username': username,
        'password': password,
        'fullname': fullname,
        'email'   : email,
        'college': college,
        'jobTitle': jobTitle
      },
      success: function(data) {
        $('.results').html(data);
      }
    });
  });

  // Edit Profile Action
  $('.edit-profile-model .content form #confirm-edit').on('click', function () {
    var nusername = $('.edit-profile-model .content form input:eq(0)').val(),
        nfullname = $('.edit-profile-model .content form input:eq(1)').val(),
        npassword = $('.edit-profile-model .content form input:eq(2)').val(),
        nemail    = $('.edit-profile-model .content form input:eq(3)').val(),
        nskills   = $('.edit-profile-model .content form input:eq(4)').val(),
        ncollege  = $('.edit-profile-model .content form input:eq(5)').val(),
        njobTitle = $('.edit-profile-model .content form input:eq(6)').val();

    $.ajax({
      url: 'ajax/editProfile.ajax.php',
      type: 'post',
      data: 'username=' + nusername + '&fullname=' + nfullname + '&password=' + npassword + '&email=' + nemail + '&college=' + ncollege + '&skills=' + nskills + '&jobTitle=' + njobTitle,
      success: function(outP) {
        $('.edit-profile-model .content .profileER').html(outP);
      }
    });

  });

});
