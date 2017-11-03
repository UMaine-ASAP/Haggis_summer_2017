$(document).ready(function()
{
  $('.criteriaRating').on('input', function(e)
  {
    var curr = e.target.id;
    var currval = $(this).val();
    $('#'+curr+".criteriaRatingout").attr('value', currval);
  });
});

function SubmitEvaluation()
{
  var completed = false;
  var formsr = $('#evalform').serialize();
  var criteriaIDs= document.getElementsByClassName('criteriaID');
  criteriaIDs = jQuery.makeArray(criteriaIDs);
  var criteriaRatings= document.getElementsByClassName('criteriaRating');
  criteriaRatings = jQuery.makeArray(criteriaRatings);
  var criteriaComment= document.getElementsByClassName('criteriaComment');
  criteriaComment = jQuery.makeArray(criteriaComment);
  var projectID = $('input[name="evalfor"]').val();
  var xmlhttp = new XMLHttpRequest();
  //alert( + " " + criteriaRatings[0].value + " " + criteriaComment[0].value + " " + projectID);
  for(var i=0; i < criteriaIDs.length;i++)
  {
    var dataString = 'criteriaID='+criteriaIDs[i].value+'&criteriaRating='+criteriaRatings[i].value+'&criteriaComment='+criteriaComment[i].value+'&projectID='+projectID;
    //alert(dataString);
    xmlhttp.open("POST", "controllers/evaluateSlinger.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(dataString);
    $.ajax({
      type: 'POST',
      url:  '/Haggis_summer_2017/controllers/evaluateSlinger.php',
      data: dataString,
      success: function()
      {
        completed = true;
      }
    });
  }

  if(completed)
  {
    $('#evalout').append('<h3>Thank you, your feedback has been submitted<h3>');
    $('#evalform').hide();
  }
  else
    $('#evalout').append('<h3>Submission did not complete successfully<h3>');

}
