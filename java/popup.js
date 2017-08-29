$(document).ready(function()
{
  var current;
  var counter = 0;

  $('#joinclass').hide();
  $('#createClass').hide();
  $('#register').hide();
  $('#passwordreset').hide();
  $('#saveSetDiv').hide();

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

  $("#savesetbut").click(function(){

    current = "#saveSetDiv";
    $(".overlay, #saveSetDiv").fadeToggle();
  })

  $(document).on("click", "#delete", function(){
    current = "#confirmDelete";
    var assignmentID = $(this).attr('name');
    $("[name='assignmentID']").val(assignmentID);
    $(".overlay, #confirmDelete").fadeToggle();
  })



});
