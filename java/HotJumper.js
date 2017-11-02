function NewAssignment(idin)
{
  $('#viewer').load("/Haggis_summer_2017/controllers/createAssignmentController.php?classID="+idin);
}
function ViewAssignment(idin)
{
  $('#viewer').load("/Haggis_summer_2017/controllers/fetchAssignmentController.php?assignmentID="+idin);
}
function GetProject(idin)
{
  $('#ProjectView').load("/Haggis_summer_2017/controllers/viewProjectController.php?projectID="+idin);
}
function GetProjectResponses(idin)
{
  $('#FinalView').load("/Haggis_summer_2017/controllers/responsesProjectController.php?id="+idin);
}
function EvaluateProject(idin)
{
  $('#FinalView').load("/Haggis_summer_2017/controllers/evaluateProjectController.php?id="+idin);
}
function GetPrompt(idin)
{
  $('#ProjectView').load("/Haggis_summer_2017/controllers/detailsAssignmentController.php?id="+idin);
}
