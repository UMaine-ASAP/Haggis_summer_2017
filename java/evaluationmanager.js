$(document).ready(function()
{
  $('.criteriaRating').on('input', function(e)
  {
    var curr = e.target.id;
    var currval = $(this).val();
    $('#'+curr+".criteriaRatingout").attr('value', currval);
  });

  $('#evalsubmit').on('click',function(e)
  {
    e.preventDefault();
    var formsr = $('#evalform').serialize();
    console.log(formsr);
    var projectID = $('input[name="evalfor"]').val();
    var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function()
    // {
    //   if(this.readyState==4 && this.status==200)
    //   {
    //     document.getElementById("evalout").append(this.responseText)
    //   }
    // };
    xmlhttp.open("POST", "?controller=evaluate&action=submit&quick=1", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(formsr);
    $('#evalout').innerHTML='<h3>Thank you, your feedback has been submitted<h3>';
    $('#evalform').hide();
  });
});
