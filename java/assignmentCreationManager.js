$(document).ready(function()
{
    $(".assignmentCreation").show();
    $("#assignmentCreationCriteria").hide();
    $(".assignmentCreationGroup").hide();
    $("#assignmentCreationReview").hide();
    $("#step1").css("background-color", "lightgreen");
});

function updateName(event)
{
  var contents = event.target.value;
  var nameChangeTargets = document.getElementsByClassName('assignmentName');
  for(var i = 0; i < nameChangeTargets.length; i++)
  {
    nameChangeTargets[i].innerHTML = contents;
  }
}

function tostart()
{
  $(".assignmentCreation").show();
  $("#assignmentCreationCriteria").hide();
  $(".assignmentCreationGroup").hide();
  $("#assignmentCreationReview").hide();
  $("#step1").css("background-color", "lightgreen");
  $("#step2").css("background-color", "white");
  $("#step3").css("background-color", "white");
  $("#step4").css("background-color", "white");
}

function tocriteria()
{
  $(".assignmentCreation").hide();
  $(".assignmentCreationCriteria").show();
  $(".assignmentCreationGroup").hide();
  $("#assignmentCreationReview").hide();
  $("#step1").css("background-color", "white");
  $("#step2").css("background-color", "lightgreen");
  $("#step3").css("background-color", "white");
  $("#step4").css("background-color", "white");
}

function toassignment()
{
  $(".assignmentCreationGroup").show();
  $(".assignmentCreationCriteria").hide();
  $(".assignmentCreation").hide();
  $("#assignmentCreationReview").hide();
  $("#step1").css("background-color", "white");
  $("#step2").css("background-color", "white");
  $("#step3").css("background-color", "lightgreen");
  $("#step4").css("background-color", "white");
}

function toreview()
{
  var criTable = document.getElementById('rubricview').cloneNode(true);
  criTable.deleteRow(criTable.rows.length-1);

  var tableHolder = document.getElementById('rubricviewer');
  tableHolder.innerHTML= "";
  tableHolder.appendChild(criTable);

  $(".assignmentCreationGroup").hide();
  $(".assignmentCreationCriteria").hide();
  $(".assignmentCreation").hide();
  $("#assignmentCreationReview").show();

  $("#step1").css("background-color", "white");
  $("#step2").css("background-color", "white");
  $("#step3").css("background-color", "white");
  $("#step4").css("background-color", "lightgreen");
}
