$(document).ready(function()
{
  $(".assignment").hide();
  $(".assignmentcreator").hide();


  $("li").click(function(e)
  {
    var inid = $(this).attr('id');
    $(".assignment").slideUp();
    $("#id"+inid).slideDown();
    $(".assignmentcreator").slideUp();
  });

  $(".newAssignment").click(function(){
    $(".assignment").slideUp();
    $(".assignmentcreator").slideDown();
  })


});
