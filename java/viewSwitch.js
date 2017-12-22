$(document).ready(function()
{
  $("#groupcreator").hide();


  $('input[name="makegroup"]').change(function()
  {
    var name = $(this).val();
    if(name == "true")
    {
      $("#groupcreator").show();
      $("#singleassignment").hide();
    }
    else
    {
      $("#groupcreator").hide();
      $("#singleassignment").show();
    }
  });

});
