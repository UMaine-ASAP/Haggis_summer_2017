$(document).ready(function()
{
  $("#submission").hide();

  $("#confirmation").keyup(function()
  {
    var currentvalue = $(this).val();
    var matchtovalue = $('#password').val();
    if(currentvalue == matchtovalue)
    {
      $("#submission").show();
      $('#note').hide();
    }
  })
});
