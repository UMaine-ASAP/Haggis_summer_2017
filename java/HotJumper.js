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
  $('#ProjectView').load("/Haggis_summer_2017/views/project/viewProject.php?projectID="+idin);
}
function GetProjectResponses(idin)
{
  $('#FinalView').load("/Haggis_summer_2017/views/project/responsesProject.php?id="+idin);
}
function EvaluateProject(idin)
{
  $('#FinalView').load("/Haggis_summer_2017/views/project/evaluateProject.php?id="+idin);
}
function GetPrompt(idin)
{
  $('#ProjectView').load("/Haggis_summer_2017/controllers/detailsAssignmentController.php?id="+idin);
}
