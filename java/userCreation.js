$(document).ready(function()
{
  $("#submission").hide();
  $('#addprofnote').hide();

  $('input[name="occupation"]').change(function()
  {
    var currentvalue = $(this).val();
    if(currentvalue === 'professor')
    {
      $('#addprofnote').show();
    }
    else
      $('#addprofnote').hide();

  });

  $("#confirmation").keyup(function()
  {
    var currentvalue = $(this).val();
    var matchtovalue = $('#password').val();
    if(currentvalue == matchtovalue)
    {
      $("#submission").show();
      $('#note').hide();
    }
    else
    {
      $("#submission").hide();
      $('#note').show();
    }
  });

  $("#password").keyup(function()
  {
    var currentvalue = $(this).val();
    var matchtovalue = $('#confirmation').val();
    if(currentvalue == matchtovalue)
    {
      $("#submission").show();
      $('#note').hide();
    }
    else
    {
      $("#submission").hide();
      $('#note').show();
    }
  })
});
