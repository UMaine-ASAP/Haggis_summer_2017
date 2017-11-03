$(document).ready(function()
{
  var currAssignment;
  //$(".assignment").hide();
  //$("#assignmentcreator").hide();
  $('.evaluate').hide();




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


});
