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
    var in = e.target.id;
    document.getElementByID('#'.in.'.details').hide();
    document.getElementByID('#'.in.'.evaluate').show();
  });

  $(".prompt").click(function(e)
  {
    var id = e.target.id;
    var splitstring = id.split('-');
    document.getElementByID('.details-'.splitstring[1]).show();
    document.getElementByID('.evaluate-'.splitstring[1]).hide();
  });

  $(".newAssignment").click(function(){
    $(".assignment").slideUp();
    $("#assignmentcreator").slideDown();
  })


});
