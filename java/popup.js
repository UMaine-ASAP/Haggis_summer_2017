$(document).ready(function()
{
  var current;

  $('#joinclass').hide();
  $('#createClass').hide();
  $('#register').hide();
  $('#passwordreset').hide();

  $(".exit").click(function(){
      $(".overlay,"+current).fadeToggle();
  })

  $(".joinClass").click(function(){
      current = "#joinClass";
      $(".overlay, #joinclass").fadeToggle();
  })

  $(".createClass").click(function(){
    current = "#createClass"
      $(".overlay, #createClass").fadeToggle();
  })

  $(".registerUser").click(function(){

    current = "#register";
      $(".overlay, #register").fadeToggle();
  })
  $(".resetPassword").click(function(){

    current = "#passwordreset";
      $(".overlay, #passwordreset").fadeToggle();
  })



});
