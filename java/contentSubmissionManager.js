// function makeSubmission()
// {
//   var formsr = $('#contentSubmission').serialize();
//   console.log(formsr);
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function()
//   {
//     if(this.readyState==4 && this.status==200)
//     {
//       document.getElementById("submissionConfirmation").prepend(this.responseText)
//     }
//   };
//   xmlhttp.open("POST", "?controller=project&action=submit&quick=1", true);
//   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xmlhttp.send(formsr);
//
// }

$(document).ready(function()
{

  $('#submitContent').on('click',function()
  {
    var projectID = $('#projectID').val();
    $('#ProjectView').load("?controller=project&action=viewAssignmentProject&quick=1&projectID="+projectID);
  });

  $('.typeselect').on('click',function()
  {
    if($(this).val() ==='file')
    {
      $('#data').replaceWith($("<input class='standard' id='data' type='file' name='data'>"));
      $('#format').val('file');
    }
    if($(this).val() ==='link')
    {
      $('#data').replaceWith($("<input class='standard' id='data' type='text' name='data' placeholder='http://'>"));
      $('#format').val('text');
    }
    if($(this).val() ==='image')
    {
      $('#data').replaceWith($("<input class='standard' id='data' type='file' name='data'>"));
      $('#format').val('image');
    }
    if($(this).val() ==='text')
    {
      $('#data').replaceWith($("<textarea id='data' class='standard' cols='70' rows='10' name='data' placeholder='Enter Text'></textarea>"));
      $('#format').val('text');
    }
  });

  $('.delete').on('click', function()
  {
    var projectID = $('#projectID').val();
    $('#ProjectView').load("?controller=project&action=viewAssignmentProject&quick=1&projectID="+projectID);
  });

});
