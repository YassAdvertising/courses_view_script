$(function () {

  $('.dashboard .stats div').addClass('tooltip');
  $('.dashboard .stats div').attr('text', 'Click to control');

  $('.navbar ul li.open-navbar').on('click', function () {
    $('.navbar ul .hidden').fadeToggle(5000);
  });

});
