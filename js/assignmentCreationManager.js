$(document).ready(function()
{
    $(".assignmentCreation").show();
    $("#assignmentCreationCriteria").hide();
    $(".assignmentCreationGroup").hide();
    $("#assignmentCreationReview").hide();
    $("#step1").css("background-color", "lightgreen");


});

function updateTarget(event, targetClassName)
{
  var tempcontents = event.target.value;
  var contents = tempcontents.replace(/\n/g, '<br>');
  var nameChangeTargets = document.getElementsByClassName(targetClassName);
  for(var i = 0; i < nameChangeTargets.length; i++)
  {
    nameChangeTargets[i].innerHTML = contents;
  }
}

function changeType(event, targetIdName)
{
  var newValue = event.target.value;
  document.getElementById(targetIdName).setAttribute("name",  newValue);
  if(newValue == 'peerEval')
  {
    $('#makegrouptruespan').hide();
    document.getElementById('makegroupFalse').checked = true;
    document.getElementById('warningMessage').innerHTML = "Warning, this assignment is setup to be a peer Evaluation. Assign only with Single Assignment";
  }
  else
  {
      document.getElementById('makegroupTrue').setAttribute('type', 'radio');
    document.getElementById('warningMessage').innerHTML="";
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
  criTableInputs = criTable.getElementsByTagName('input');

  for(var i = criTableInputs.length-1; i >-1; i--)
  {

    var currInput = criTableInputs[i];

    var newElem = document.createElement('span');
    newElem.innerHTML = currInput.value;
    currInput.parentNode.setAttribute('style', 'text-align:center');
    currInput.parentNode.replaceChild(newElem, currInput);

  }
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
