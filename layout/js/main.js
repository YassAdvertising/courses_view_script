$(function () {

  // Open And Close Login Form Model
  $('.navbar-main ul li.open-loginmodel').on('click', function () { // Open
    $('.body-overlay').fadeIn();
    $('.loginform-model').animate({
      top: '50px'
    }, 500);
  });
  $('.loginform-model .header span, .body-overlay').on('click', function () {
    $('.body-overlay').fadeOut();
    $('.loginform-model').animate({
      top: '-900px'
    }, 350);
  });

  // Show Navbar
  $('.navbar-main .open-nav').on('click', function () {
    $('.navbar-main .in-small-devices').slideToggle();
  });

  // Introducation Section On Load
  $(window).on('load', function () {
    $('.on-load').fadeOut(4000);
  });

  // User Dropdown Toggle [ Close - Open ]
  $('.navbar-main ul .open-user-dropdown').on('click', function () {
    $('.dropdown-user').fadeToggle();
  });

  // Edit Profile Model - Open it
  $('.edit-profile-tool').on('click', function () {
    $('.edit-profile-model').addClass('transform-scale');
  });

  // Edit Profile Model - Close it
  $('.edit-profile-model .header > i').on('click', function () {
    $('.edit-profile-model').removeClass('transform-scale');
  });

})
