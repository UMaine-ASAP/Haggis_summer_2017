$(document).ready(function()
{
  $(".assignment").hide();
  $("#assignmentcreator").hide();
  $('.evaluate').hide();


  $(".assignments").click(function(e)
  {
    var inid = $(this).attr('id');
    $(".assignment").slideUp();
    $("#id"+inid).slideDown();
    $("#assignmentcreator").slideUp();
  });

  $(".givecritique").click(function(e)
  {
    var thing = e.target.id;
    $('#'+thing+'.details').hide();
    $('#'+thing+'.evaluate').show();
  });

  $(".prompt").click(function(e)
  {
    var thing = e.target.id;
    $('#'+thing+'.details').show();
    $('#'+thing+'.evaluate').hide();
  });

  $(".newAssignment").click(function(){
    $(".assignment").slideUp();
    $("#assignmentcreator").slideDown();
  })


});
