$(document).ready(function()
{
  $(".assignment").hide();
  $("#assignmentcreator").hide();


  $("li").click(function(e)
  {
    var inid = $(this).attr('id');
    $(".assignment").slideUp();
    $("#id"+inid).slideDown();
    $("#assignmentcreator").slideUp();
  });

  $(".newAssignment").click(function(){
    $(".assignment").slideUp();
    $("#assignmentcreator").slideDown();
  })

  $('[name = "searchString"]').keyup(function()
  {
    var sub =  $(this).val().toLowerCase();
    var elements = document.getElementsByClassName('assignments');
    for(var i = 0; i < elements.length; i++)
    {
      var searchin = elements[i].innerText;
      var index = searchin.toLowerCase().indexOf(sub);
      if( index !=-1)
      {
        elements[i].style.backgroundColor='yellow';
      }
      else
      {
        elements[i].style.backgroundColor='';
      }
    }
  })
});
